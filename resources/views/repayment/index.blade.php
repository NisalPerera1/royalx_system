@extends('layouts.admin_includes.app')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Repayment Management</h3>
                        </div>
                    </div>
                </div>

                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <a href="{{ route('home') }}" class="btn btn-danger">
                                            <em class="icon ni ni-arrow-left"></em>
                                            <span>Go to Dashboard</span>
                                        </a>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newRepaymentModal">
                                            <em class="icon ni ni-plus"></em>
                                            <span>Record Repayment</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Modal: New Repayment -->
                    <div class="modal fade" id="newRepaymentModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="repaymentForm">
<!-- <form id="repaymentForms" action="{{ route('repayment.store') }}" method="POST"> -->

                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Record New Repayment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label for="loan_id" class="form-label">Loan</label>
                                                <select class="form-select" name="loan_id" id="loan_id" required>
                                                    <option value="" selected disabled>Choose loan</option>
                                                    @foreach($loans as $loan)
                                                        <option value="{{ $loan->id }}">
                                                            {{ $loan->client->name }} - Rs. {{ number_format($loan->loan_amount, 2) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="amount" class="form-label">Amount Paid</label>
                                                <input type="number" class="form-control" name="amount" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="payment_date" class="form-label">Payment Date</label>
                                                <input type="date" class="form-control" name="payment_date" required>
                                            </div>
                                            <div class="col-md-6">
                                                                                                    <!-- Hidden fallback for is_late -->
                                                    <input type="hidden" name="is_late" value="0">

                                                    <label class="form-check">
                                                        <input type="checkbox" class="form-check-input" name="is_late" value="1">
                                                        <span class="form-check-label">Late Payment?</span>
                                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save Repayment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

<!-- Repayment History Modal -->
<div class="modal fade" id="repaymentModal" tabindex="-1" role="dialog" aria-labelledby="repaymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Repayment History</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Payment Date</th>
              <th>Amount</th>
              <th>Late</th>
            </tr>
          </thead>
          <!-- <tbody id="repayment-history-body"> -->
            <tbody>
    @forelse($repayments as $index => $repayment)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($repayment->payment_date)->format('Y-m-d') }}</td>
            <td>{{ number_format($repayment->amount, 2) }}</td>
            <td>
                @if($repayment->is_late)
                    <span class="badge bg-danger">Yes</span>
                @else
                    <span class="badge bg-success">No</span>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center">No repayments found.</td>
        </tr>
    @endforelse
</tbody>

            <!-- Dynamic rows will be inserted here -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>





                    <!-- Table -->
                    <div class="card card-preview">
                        <div class="card-inner">
                            <table class="table datatable-init" id="data-table">
                                <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Loan Amount</th>
                                        <th>Total Due</th>
                                        <th>Total Paid</th>
                                        <th>Remaining</th>
                                        <th>Status</th>
                                        <th width="100px">Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    NioApp.DataTable.init = function () {
        NioApp.DataTable('.datatable-init', {
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('repayment.index') }}",
            columns: [
                { data: 'client' },
                { data: 'loan_amount' },
                { data: 'total_due' },
                { data: 'total_paid' },
                { data: 'remaining' },
                { data: 'status' },
                { data: 'action', orderable: false, searchable: false }
            ]
        });
    };

  $('#repaymentForm').submit(function(e) {
    e.preventDefault();

    const form = $(this);
    const formData = new FormData(this);

    // Optional: disable button to prevent double clicks
    const submitBtn = form.find('button[type="submit"]');
    submitBtn.prop('disabled', true).text('Processing...');

    $.ajax({
        type: 'POST',
        url: "{{ route('repayment.store') }}",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            $('#newRepaymentModal').modal('hide');
            $('.datatable-init').DataTable().ajax.reload();
            form[0].reset();
            NioApp.Toast(data.message, 'success', { position: 'bottom-right' });
        },
        error: function(err) {
            if (err.status === 422) {
                const errors = err.responseJSON.errors;
                $.each(errors, function(i, error) {
                    NioApp.Toast(error, 'error', { position: 'bottom-right' });
                    console.error('Server Error:', err);

                });
            } else {
                // Show general server error
                const msg = err.responseJSON?.message || 'Server error. Please try again.';
                NioApp.Toast(msg, 'error', { position: 'bottom-right' });
                console.error('Server Error:', err);
            }
        },
        complete: function() {
            // Re-enable the button
            submitBtn.prop('disabled', false).text('Add Repayment');
        }
    });
});



function view(loanId) {
    console.log("View payments for loan ID:", loanId);

    $('#repaymentModal').modal('show');
    loadRepayments(loanId); // you define this
}


</script>
@endsection
