@extends('layouts.admin_includes.app')

@section('content')
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Client Management</h3>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt"><a href="{{route('home')}}" class="btn btn-danger"><em class="icon ni ni-arrow-left"></em><span>Go to Dashboard</span></a></li>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newClientModal">
                                                <em class="icon ni ni-arrow-down"></em><span>New Client</span>
                                            </button>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div>


        <!-- Modal -->
        <div class="modal fade" id="newClientModal" tabindex="-1" aria-labelledby="newClientModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="clientForm" enctype="multipart/form-data">

                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="newClientModalLabel">Add New Client</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                    <!-- Name -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Client Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>

                                    <!-- Contact -->
                                    <div class="mb-3">
                                        <label for="contact" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="contact" name="contact" required>
                                    </div>

                                    <!-- Address -->
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" name="address" rows="2"></textarea>
                                    </div>

                                    <!-- ID Proof -->
                                    <div class="mb-3">
                                        <label for="id_proof" class="form-label">NIC Number</label>
                                        <input type="text" class="form-control" id="id_proof" name="id_proof">
                                    </div>

                                    <!-- NIC/BR File Upload -->
                                    <div class="mb-3">
                                        <label for="id_proof_file" class="form-label">NIC/BR Scan/Image</label>
                                        <input type="file" class="form-control" id="id_proof_file" name="id_proof_file" accept="image/*">
                                    </div>

                                    <!-- Guarantor -->
                                    <div class="mb-3">
                                        <label for="guarantor" class="form-label">Guarantor</label>
                                        <input type="text" class="form-control" id="guarantor" name="guarantor">
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save Client</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                </form>
                                    </div>

                                </div>
                            </div>



                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="table datatable-init" id="data-table">
                                        <thead>
                                        <tr>
                                            <th>Client Name</th>
                                            <th>Client Address</th>
                                            <th>Client Phone</th>
                                            <th>Client NIC</th>
                                            <th>Guarantor</th>
                                            <th width="100px">Actions</th>
                                        </tr>

                                        </thead>

                                    </table>
                                </div>
                            </div><!-- .card-preview -->
                        </div> <!-- nk-block -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Client Modal -->
        <div class="modal fade" id="EditModalForm" tabindex="-1" role="dialog" aria-labelledby="editClientModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
    <form id="editclientForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="editClientModalLabel">Edit Client</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
            <input type="hidden" id="edit_Client_id" name="Client_id">

            <div class="row">
                <!-- Left column -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_name" name="edit_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_contact" class="form-label">Contact Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_contact" name="edit_contact" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="edit_address" name="edit_address">
                    </div>

                    <div class="mb-3">
                        <label for="edit_guarantor" class="form-label">Guarantor</label>
                        <input type="text" class="form-control" id="edit_guarantor" name="edit_guarantor">
                    </div>
                </div>

                <!-- Right column -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="edit_id_proof" class="form-label">NIC / BR Number</label>
                        <input type="text" class="form-control" id="edit_id_proof" name="edit_id_proof">
                    </div>

                    <div class="mb-3">
                        <label for="edit_id_proof_file" class="form-label">Upload NIC/BR Image</label>
                        <input type="file" class="form-control" id="edit_id_proof_file" name="edit_id_proof_file" accept="image/*,.pdf">
                        <small class="text-muted">Accepted: JPG, PNG, PDF (max 2MB)</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Current ID Image</label>
                        <div>
                            <img id="edit-image-preview" src="" alt="Current ID" style="max-width: 100%; max-height: 200px; border: 1px solid #ddd;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Update Client</button>
        </div>
    </form>
</div>

            </div>
        </div>


        <!-- Delete Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="deleteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form id="delete-form" method="POST" enctype="multipart/form-data" class="gy-3">
                    @csrf
                    <input type="hidden" name="delete_id" id="delete_id" value="">
                    <div class="modal-content">
                        <!-- Modal Header with Close Button -->
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body text-center">
                            <div class="nk-modal">
                                <!-- Warning Icon -->
                                <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-alert bg-warning mb-4"></em>

                                <!-- Modal Title -->
                                <h4 class="nk-modal-title mb-3">Delete Client</h4>

                                <!-- Confirmation Text -->
                                <div class="nk-modal-text">
                                    <p class="lead">Are you sure you want to <strong>delete</strong> this Client?</p>
                                    <p class="sub-text-sm text-muted">This action cannot be undone.</p>
                                </div>

                                <!-- Modal Actions with Buttons -->
                                <div class="nk-modal-action d-flex justify-content-center mt-4">
                                    <!-- Cancel Button -->
                                    <button type="button" class="btn btn-lg btn-light me-2" data-bs-dismiss="modal">
                                        No, Go Back
                                    </button>

                                    <!-- Confirm Delete Button -->
                                    <button type="submit" class="btn btn-lg btn-danger">
                                        Yes, Delete
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Optional: Add a border or footer if needed -->
                    </div>
                </form>
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
            ajax: "{{ route('client.index') }}",  // Add the correct ajax URL here
            columns: [
                {data: 'name', name: 'name'},
                {data: 'address', name: 'address'},
                {data: 'contact', name: 'contact'},
                {data: 'id_proof', name: 'id_proof'},
                {data: 'guarantor', name: 'guarantor'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $.fn.DataTable.ext.pager.numbers_length = 7;
    };

    // Create new client
    $("#clientForm").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('client.store') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#clientForm button[type="submit"]').attr('disabled', true);
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
                    $('#newClientModal').modal('hide');
                    $('#clientForm')[0].reset();
                    $('.modal-backdrop').remove();
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
                $('#clientForm button[type="submit"]').attr('disabled', false);
            }
        });
    });

    var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
    var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl)
    });

    // Edit client function
 function editclient(id, name, address, contact, id_proof, guarantor, id_proof_file_url) {
    $('#edit_Client_id').val(id);
    $('#edit_name').val(name);
    $('#edit_address').val(address);
    $('#edit_contact').val(contact);
    $('#edit_id_proof').val(id_proof);
    $('#edit_guarantor').val(guarantor);

    console.log("Image URL:", id_proof_file_url); // For debugging
    $('#edit-image-preview').attr('src', id_proof_file_url); // ✅ Correct ID

    const modal = new bootstrap.Modal(document.getElementById('EditModalForm'));
    modal.show();
}




   // Update client form submit
$("form#editclientForm").submit(function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    var clientId = $('#edit_Client_id').val(); // Corrected ID field

    $.ajax({
        type: 'POST',
        url: "{{ route('client.update', ':id') }}".replace(':id', clientId),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        success: function (data) {
            $('.datatable-init').DataTable().ajax.reload();
            $('#EditModalForm').modal('hide');

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
