<div class="tb-odr-btns d-none d-md-inline float-end">
    <ul class="nk-tb-actions gx-2">
        <li>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                    <em class="icon ni ni-more-h"></em>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <ul class="link-list-opt no-bdr">

                        {{-- ✏️ Edit Button --}}
                       <li>
    <a href="javascript:void(0)"
       onclick="editloan(
           '{{ $model->id }}',
           '{{ $model->client_id }}',
           '{{ $model->loan_amount }}',
           '{{ $model->total_amount }}',
           '{{ $model->daily_repayment }}',
           '{{ $model->start_date }}',
           '{{ $model->duration_days }}',
           '{{ $model->status }}',
           `{{ addslashes($model->notes) }}`
       )">
        <em class="icon ni ni-edit"></em>
        <span>Edit</span>
    </a>
</li>


                        {{-- 🗑️ Delete Button --}}
                        <li>
                            <a href="javascript:void(0)" onclick="del('{{ $model->id }}')">
                                <em class="icon ni ni-trash"></em>
                                <span>Delete</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </li>
    </ul>
</div>

{{-- 🔒 Hidden Delete Form --}}
<form method="POST" id="f-{{ $model->id }}" action="{{ route('loan.delete', $model->id) }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>
