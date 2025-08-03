<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Repayment;
use Yajra\DataTables\DataTables;
use App\Models\Client;
use Illuminate\Support\Str;




class RepaymentController extends Controller
{




public function index(Request $request)
{
    $clients = Client::all(); // load for the view
    $repayments = Repayment::with('loan')->latest()->get(); // if you need this for the view

    if ($request->ajax()) {
        $data = Loan::with(['client', 'repayments'])->latest()->get();

        return DataTables::of($data)
            ->addColumn('client', fn($loan) => $loan->client->name)
            ->addColumn('loan_amount', fn($loan) => number_format($loan->loan_amount, 2))
            ->addColumn('total_due', fn($loan) => number_format($loan->total_amount, 2))
            ->addColumn('total_paid', fn($loan) => number_format($loan->repayments->sum('amount'), 2))
            ->addColumn('remaining', function ($loan) {
                $paid = $loan->repayments->sum('amount');
                $due = $loan->total_amount;
                return number_format($due - $paid, 2);
            })
            ->addColumn('status', function ($loan) {
                $paid = $loan->repayments->sum('amount');
                return $paid >= $loan->total_amount
                    ? '<span class="badge bg-success">Paid</span>'
                    : '<span class="badge bg-warning text-dark">Ongoing</span>';
            })
            ->rawColumns(['status'])
            ->addColumn('action', fn($loan) => view('repayment.includes.actions', ['model' => $loan]))
            ->make(true);
    }

    $loans = Loan::with('client')->get();

    return view('repayment.index', compact('loans', 'clients', 'repayments'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request) 
{
    $request->validate([
        'loan_id' => 'required|exists:loans,id',
        'amount' => 'required|numeric|min:0.01',
        'payment_date' => 'required|date',
    ]);

    // Get loan with current repayments
    $loan = Loan::with('repayments')->findOrFail($request->loan_id);

    $totalDue = $loan->total_amount;
    $totalPaid = $loan->repayments->sum('amount');
    $remaining = $totalDue - $totalPaid;

    // Prevent overpayment
    if ($request->amount > $remaining) {
        return response()->json([
            'status' => false,
            'message' => 'Payment exceeds remaining balance!',
        ], 422);
    }

    // Store repayment
    Repayment::create([
        'id' => Str::uuid(),
        'loan_id' => $loan->id,
        'payment_date' => $request->payment_date,
        'amount' => $request->amount,
        'is_late' => $request->is_late ?? false,
    ]);

    // Refresh to include new repayment
    $loan->refresh();

    $newTotalPaid = $loan->repayments->sum('amount');

    // If fully paid, mark as completed (matching enum)
    if ($newTotalPaid >= $loan->total_amount) {
        $loan->update(['status' => 'completed']); // ✅ enum value from migration
    }

    return response()->json([
        'status' => true,
        'message' => 'Repayment recorded successfully.',
    ]);
}



public function history($loanId)
{
    $repayments = Repayment::where('loan_id', $loanId)->orderBy('payment_date');

    return DataTables::of($repayments)
        ->addIndexColumn()
        ->editColumn('amount', fn($row) => number_format($row->amount, 2))
        ->editColumn('is_late', fn($row) => $row->is_late
            ? '<span class="badge bg-danger">Yes</span>'
            : '<span class="badge bg-success">No</span>'
        )
        ->rawColumns(['is_late'])
        ->make(true);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
