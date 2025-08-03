<div class="tb-odr-btns d-none d-md-inline float-right">
    <ul class="nk-tb-actions gx-2">
        <li>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                    <em class="icon ni ni-more-h"></em>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <ul class="link-list-opt no-bdr">
                        <!-- Edit Button -->

<li>
    <a href="javascript:void(0);" onclick="view('{{ $model->id }}')">
        <em class="icon ni ni-eye"></em>
        <span>View Payments</span>
    </a>
</li>


<!-- 
                        <li>
    <a href="javascript:void(0)" 
       onclick="editclient(
           '{{ $model->id }}',
           '{{ $model->name }}',
           '{{ $model->address }}',
           '{{ $model->contact }}',
           '{{ $model->id_proof }}',
           '{{ $model->guarantor }}',
           '{{ asset('storage/' . $model->id_proof_file) }}')">
           
        <em class="icon ni ni-edit"></em>
        <span>Edit</span>
    </a>
</li> -->



                        <!-- Delete Button -->
                        <!-- <li>
                            <a onclick="del('{{$model->id}}')">
                                <em class="icon ni ni-trash"></em>
                                <span>Delete</span>
                            </a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</div>

<!-- Hidden Delete Form -->
<form action="" method="POST" id="f-{{ $model->id }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>
