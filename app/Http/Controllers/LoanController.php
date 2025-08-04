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
        'client_id'         => 'required|exists:clients,id',
        'loan_amount'       => 'required|numeric|min:1000',
        'interest_rate'     => 'required|numeric|min:0',
        'term'              => 'required|integer|min:1',
        'daily_installment' => 'required|numeric|min:1',
        'total_days'        => 'required|integer|min:1',
        'start_date'        => 'required|date',
        'notes'             => 'nullable|string',
    ]);

    $expectedTotal = $validated['loan_amount'] + ($validated['loan_amount'] * $validated['interest_rate'] / 100);
    $calculatedTotal = $validated['daily_installment'] * $validated['total_days'];

    // Allowing a small margin for rounding differences
    if (abs($expectedTotal - $calculatedTotal) > 1) {
        return response()->json([
            'message' => 'Total repayment does not match the loan amount with interest.',
            'expected_total' => round($expectedTotal, 2),
            'calculated_total' => round($calculatedTotal, 2),
        ], 422);
    }

    $loan = Loan::create([
        'client_id'       => $validated['client_id'],
        'loan_amount'     => $validated['loan_amount'],
        'total_amount'    => $calculatedTotal,
        'daily_repayment' => $validated['daily_installment'],
        'duration_days'   => $validated['total_days'],
        'start_date'      => $validated['start_date'],
        'status'          => 'active',
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
        'edit_client_id'      => 'required|exists:clients,id',
        'edit_loan_amount'    => 'required|numeric|min:0',
        'edit_total_amount'   => 'required|numeric|min:0',
        'edit_daily_repayment'=> 'required|numeric|min:0',
        'edit_start_date'     => 'required|date',
        'edit_duration_days'  => 'required|numeric|min:1',
        'edit_status'         => 'required|in:active,completed,defaulted',
        'edit_notes'          => 'nullable|string',
    ]);

    $expectedTotal = $validated['edit_daily_repayment'] * $validated['edit_duration_days'];
    
    // Compare calculated total with provided total
    if (abs($expectedTotal - $validated['edit_total_amount']) > 1) {
        return response()->json([
            'message' => 'The total amount (with interest) does not match the repayment plan.',
        ], 422);
    }

    $loan = Loan::findOrFail($id);

    $loan->update([
        'client_id'       => $validated['edit_client_id'],
        'loan_amount'     => $validated['edit_loan_amount'],
        'total_amount'    => $validated['edit_total_amount'],
        'daily_repayment' => $validated['edit_daily_repayment'],
        'duration_days'   => $validated['edit_duration_days'],
        'start_date'      => $validated['edit_start_date'],
        'status'          => $validated['edit_status'],
        'notes'           => $validated['edit_notes'],
    ]);

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
