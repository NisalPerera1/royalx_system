@extends('layouts.admin_includes.app')

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Loan Management</h3>
                        </div>
                    </div>
                </div>

                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu">
                                    <em class="icon ni ni-menu-alt-r"></em>
                                </a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a href="{{ route('home') }}" class="btn btn-danger">
                                                <em class="icon ni ni-arrow-left"></em><span>Go to Dashboard</span>
                                            </a>
                                        </li>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newLoanModal">
                                            <em class="icon ni ni-plus"></em><span>New Loan</span>
                                        </button>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- New Loan Modal -->
                    <div class="modal fade" id="newLoanModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="loanForm" enctype="multipart/form-data">

                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add New Loan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Client -->
                                        <div class="mb-3">
                                            <label class="form-label">Select Client</label>
                                            <select name="client_id" id="client_id" class="form-control" required>
                                                @foreach($clients as $client)
                                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Amount -->
                                        <div class="mb-3">
                                            <label class="form-label">Loan Amount</label>
                                            <input type="number" name="loan_amount" class="form-control" required>
                                        </div>

                                        <!-- Interest -->
                                        <div class="mb-3">
                                            <label class="form-label">Interest Rate (%)</label>
                                            <input type="number" name="interest_rate" class="form-control" required>
                                        </div>

                                        <!-- Term -->
                                        <div class="mb-3">
                                            <label class="form-label">Loan Term (months)</label>
                                            <input type="number" name="term" class="form-control" required>
                                        </div>

                                         <!-- Term -->
                                        <div class="mb-3">
                                            <label class="form-label">Daily Installement</label>
                                            <input type="number" name="daily_installment" class="form-control" required>
                                        </div>
                                         <!-- Term -->
                                        <div class="mb-3">
                                            <label class="form-label">Total Days</label>
                                            <input type="number" name="total_days" class="form-control" required>
                                        </div>


                                        <!-- Start Date -->
                                        <div class="mb-3">
                                            <label class="form-label">Start Date</label>
                                            <input type="date" name="start_date" class="form-control" required>
                                        </div>

                                        <!-- Notes -->
                                        <div class="mb-3">
                                            <label class="form-label">Notes (optional)</label>
                                            <textarea name="notes" class="form-control" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save Loan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Loan Table -->
                    <div class="card card-preview">
                        <div class="card-inner">
                            <table class="table datatable-init" id="loan-table">
                                <thead>
                                   <tr>
                                        <th>Client</th>
                                        <th>Amount</th>
                                        <th>Interest</th>
                                        <th>Term</th>
                                        <th>Start Date</th>
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

<!-- Edit Loan Modal -->
<div class="modal fade" id="EditLoanModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <form id="editLoanForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Loan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="edit_loan_id" name="edit_loan_id">

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Client Dropdown -->
                            <div class="mb-3">
                                <label class="form-label">Client</label>
                                <select id="edit_client_id" name="edit_client_id" class="form-control" required>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Loan Amount -->
                            <div class="mb-3">
                                <label class="form-label">Loan Amount</label>
                                <input type="number" id="edit_loan_amount" name="edit_loan_amount" class="form-control" required>
                            </div>

                            <!-- Total Amount -->
                            <div class="mb-3">
                                <label class="form-label">Total Amount (with interest)</label>
                                <input type="number" id="edit_total_amount" name="edit_total_amount" class="form-control" required>
                            </div>

                            <!-- Daily Repayment -->
                            <div class="mb-3">
                                <label class="form-label">Daily Repayment</label>
                                <input type="number" id="edit_daily_repayment" name="edit_daily_repayment" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Start Date -->
                            <div class="mb-3">
                                <label class="form-label">Start Date</label>
                                <input type="date" id="edit_start_date" name="edit_start_date" class="form-control" required>
                            </div>

                            <!-- Duration (Days) -->
                            <div class="mb-3">
                                <label class="form-label">Duration (Days)</label>
                                <input type="number" id="edit_duration_days" name="edit_duration_days" class="form-control" required>
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select id="edit_status" name="edit_status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="completed">Completed</option>
                                    <option value="defaulted">Defaulted</option>
                                </select>
                            </div>

                            <!-- Notes -->
                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <textarea id="edit_notes" name="edit_notes" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Update Loan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>




    <!-- Delete Loan Modal -->
    <div class="modal fade" id="deleteLoanModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="delete-loan-form" method="POST">
                @csrf
                <input type="hidden" name="delete_id" id="delete_loan_id">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <em class="icon icon-circle icon-circle-xxl ni ni-alert bg-warning mb-4"></em>
                        <h4 class="mb-3">Delete Loan</h4>
                        <p>Are you sure you want to delete this loan? This action cannot be undone.</p>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="button" class="btn btn-lg btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-lg btn-danger">Yes, Delete</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">

    NioApp.DataTable.init = function () {

        NioApp.DataTable('.datatable-init', {
            responsive: {
                details: true
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('loan.index') }}",
            columns: [
                    { data: 'client_name', name: 'client_name' },
                    { data: 'amount', name: 'amount' },
                    { data: 'interest', name: 'interest' },
                    { data: 'term', name: 'term' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
        });

        $.fn.DataTable.ext.pager.numbers_length = 7;
    };

// Create new loan
$("#loanForm").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        type: 'POST',
        url: "{{ route('loan.store') }}", // Ensure this route is defined in web.php
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $('#loanForm button[type="submit"]').attr('disabled', true);
        },
        success: function(data) {
            $('.datatable-init').DataTable().ajax.reload();

            setTimeout(function() {
                toastr.clear();
                NioApp.Toast(data.message, 'success', {
                    position: 'bottom-right',
                    ui: 'is-dark'
                });
            }, 100);

            setTimeout(function() {
                // $('#LoanModalForm').modal('hide');
                $('#newLoanModal').modal('hide');
                $('#loanForm')[0].reset();
                $('.modal-backdrop').remove(); // Optional — use only if modals misbehave
            }, 3000);
        },
        error: function(err) {
            if (err.status === 422) {
                $.each(err.responseJSON.errors, function(i, error) {
                    setTimeout(function() {
                        NioApp.Toast(error, 'error', {
                            position: 'bottom-right',
                            ui: 'is-dark'
                        });
                    }, 500);
                });
            }
        },
        complete: function() {
            $('#loanForm button[type="submit"]').attr('disabled', false);
        }
    });
});

function editloan(id, client_id, loan_amount, total_amount, daily_repayment, start_date, duration_days, status, notes) {
    $('#edit_loan_id').val(id);
    $('#edit_client_id').val(client_id);
    $('#edit_loan_amount').val(loan_amount);
    $('#edit_total_amount').val(total_amount);
    $('#edit_daily_repayment').val(daily_repayment);
    $('#edit_start_date').val(start_date);
    $('#edit_duration_days').val(duration_days);
    $('#edit_status').val(status);
    $('#edit_notes').val(notes);

    const modal = new bootstrap.Modal(document.getElementById('EditLoanModal'));
    modal.show();
    console.log('Editing Loan ID:', id);
}


$("form#editLoanForm").submit(function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    var loanId = $('#edit_loan_id').val();

    // Add method spoofing
    formData.append('_method', 'PUT');

    $.ajax({
        type: 'POST',
        url: "{{ route('loan.update', ':id') }}".replace(':id', loanId),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        success: function (data) {
            $('.datatable-init').DataTable().ajax.reload();
            $('#EditLoanModal').modal('hide');

            setTimeout(function () {
                toastr.clear();
                NioApp.Toast(data.message, 'info', {
                    position: 'bottom-right',
                    ui: 'is-dark'
                });
            }, 100);
        },
        error: function (err) {
            if (err.status === 422) {
                $.each(err.responseJSON.errors, function (i, error) {
                    setTimeout(function () {
                        NioApp.Toast(error, 'error', {
                            position: 'bottom-right',
                            ui: 'is-dark'
                        });
                    }, 500);
                });
            } else {
                NioApp.Toast('Something went wrong. Please try again.', 'error', {
                    position: 'bottom-right'
                });
            }
        }
    });
});


    // Delete client
    function del(id) {
        $('#delete_id').val(id);
        $('#deleteModal').modal('show');
    }

    $("form#delete-form").submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('client.delete') }}",
            type: 'POST',
            data: $("#delete-form").serialize(),
            success: function(data) {
                $('.datatable-init').DataTable().ajax.reload();
                $('#deleteModal').modal('hide');

                setTimeout(function () {
                    toastr.clear();
                    NioApp.Toast(data.message, 'warning', {
                        position: 'bottom-right',
                        ui: 'is-dark'
                    });
                }, 100);
            },
            error: function (err) {
                if (err.status === 422) {
                    $.each(err.responseJSON.errors, function(i, error) {
                        setTimeout(function() {
                            NioApp.Toast(error, 'error', {
                                position: 'bottom-right',
                                ui: 'is-dark'
                            });
                        }, 500);
                    });
                }
            }
        });
    });

</script>
@endsection
