@extends('layout.admin.app')
@section('content')

{{-- Breadcrumb --}}
<div class="col-md-12 card shadow-none position-relative overflow-hidden m-0" style="background: var(--light-red)">
    <div class="card-body px-md-4 px-3 py-2">
        <div class="row align-items-center">
            <div class="col-md-9 col py-2">
                <h4 class="fw-semibold">Other Activities</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item fw-semibold" aria-current="page">Other Activities</li>
                    </ol>
                </nav>
            </div>
            <div class="col-3 d-md-block d-none">
                <div class="text-end mb-n4 me-n4">
                    <i class="menu-section-icon ti ti-speakerphone"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body px-md-4 px-3 py-md-3 py-3">
                <div class="col d-flex align-items-center justify-content-between mb-3 gap-md-0 gap-2">
                    <h4 class="m-0">List Other Activities</h4>
                    <a class="btn btn-primary d-flex align-items-center fs-2" href="{{ route('admin.create_other_activities') }}" role="button">
                        <i class="ti ti-square-rounded-plus fs-5"></i>
                        <span class="d-md-block d-none ms-2">Add New</span>
                    </a>
                </div>
                <table class="table table-bordered hover" id="listotheractivities" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Organization Name</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Date</th>
                            <th scope="col">Highlight</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Delete --}}
<div class="modal fade" id="delete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header">
                <div class="col d-flex gap-2 align-items-center">
                    <i class="ti ti-info-square-rounded"></i>
                    <h6 class="modal-title ms-1" id="title-info">Delete</h6>
                </div>
            </div>
            <div class="modal-body text-center mt-3 mb-1">
                <p id="desc-info">Are you sure, you want to Delete this Other Activities?</p>
            </div>
            <div class="modal-footer d-flex align-items-center justify-content-center border-0 gap-2 mb-2">
                <button type="submit" style="font-size: 13px" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <form action="" method="POST" id="form_delete">
                    @csrf
                    <button type="submit" id="" style="font-size: 13px; background: var(--danger);">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    // List Other Activities
    $(function() {
        $('#listotheractivities').DataTable({
            scrollX: true,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.data_other_activities') }}',
            columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'organization_name',
                        name: 'organization_name'
                    },
                    {
                        data: 'roles',
                        name: 'roles'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        class: 'text-center'
                    },
                    {
                        data: 'date',
                        name: 'date',
                        class: 'text-center'
                    },
                    {
                        data: 'highlight',
                        name: 'highlight',
                        class: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        class: 'text-center'
                    },
                ]
        });
    });
    function formDelete(id){
        $('#form_delete').attr('action', '{{ url('/admin/other-activities/delete/') }}' + '/' + id);
    };
</script>
@endsection