<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class LoanController extends Controller
{

    public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Loan::with('client', 'repayments')->latest()->get();

        return DataTables::of($data)
            ->setRowId(fn($loan) => $loan->id)
            ->addColumn('client_name', fn($loan) => $loan->client->name)
            ->addColumn('amount', fn($loan) => number_format($loan->loan_amount, 2))
            ->addColumn('interest', fn($loan) => number_format($loan->total_amount - $loan->loan_amount, 2))
            ->addColumn('term', fn($loan) => $loan->duration_days . ' days')

            // ✅ Use status badge based on payment progress
          ->addColumn('status', function ($loan) {
    if ($loan->status === 'completed') {
        return '<span class="badge bg-success">Paid</span>';
    } elseif ($loan->status === 'defaulted') {
        return '<span class="badge bg-danger">Defaulted</span>';
    } else {
        return '<span class="badge bg-warning text-dark">Ongoing</span>'; // active
    }
})


            // ✅ Pass the is_fully_paid flag to the action view
            ->addColumn('action', fn($loan) => view('loan.includes.actions', ['model' => $loan, 'isFullyPaid' => $loan->is_fully_paid]))

            ->rawColumns(['status', 'action']) // Allow HTML badges
            ->addIndexColumn()
            ->make(true);
    }

    $clients = Client::all();
    return view('loan.index', compact('clients'));
}

  
  public function store(Request $request)
{
    $validated = $request->validate([
        'client_id'        => 'required|exists:clients,id',
        'loan_amount'      => 'required|numeric|min:1000',
        'interest_rate'    => 'required|numeric|min:0',
        'term'             => 'required|integer|min:1',
        'daily_installment'=> 'required|numeric|min:1',
        'total_days'       => 'required|integer|min:1',
        'start_date'       => 'required|date',
        'notes'            => 'nullable|string',
    ]);

    // Calculate total amount from daily installment * total days
    $total_amount = $validated['daily_installment'] * $validated['total_days'];

    // Create the loan record
    $loan = Loan::create([
        'client_id'       => $validated['client_id'],
        'loan_amount'     => $validated['loan_amount'],
        'total_amount'    => $total_amount,
        'daily_repayment' => $validated['daily_installment'],
        'duration_days'   => $validated['total_days'],
        'start_date'      => $validated['start_date'],
        'status'          => 'active', // default status
        'notes'           => $validated['notes'] ?? null,
    ]);

    return response()->json([
        'message' => 'Loan added successfully!',
        'loan'    => $loan,
    ]);
}





    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'edit_client_id'         => 'required|exists:clients,id',
            'edit_amount'            => 'required|numeric',
            'edit_daily_installment' => 'required|numeric',
            'edit_total_days'        => 'required|numeric',
            'edit_start_date'        => 'required|date',
            'edit_status'            => 'required|string',
        ]);

        $loan = Loan::findOrFail($id);

        $data = [
            'client_id'         => $validated['edit_client_id'],
            'amount'            => $validated['edit_amount'],
            'daily_installment' => $validated['edit_daily_installment'],
            'total_days'        => $validated['edit_total_days'],
            'start_date'        => $validated['edit_start_date'],
            'total_repayable'   => $validated['edit_daily_installment'] * $validated['edit_total_days'],
            'end_date'          => date('Y-m-d', strtotime($validated['edit_start_date'] . " +{$validated['edit_total_days']} days")),
            'status'            => $validated['edit_status'],
        ];

        $loan->update($data);

        return response()->json([
            'message' => 'Loan updated successfully!',
            'loan' => $loan
        ]);
    }

    public function delete(Request $request)
    {
        $loan = Loan::findOrFail($request->delete_id);
        $loan->delete();

        return response()->json(['message' => 'Loan deleted successfully!']);
    }
}
