@extends('layout.admin.app')
@section('content')

{{-- Breadcrumb --}}
<div class="col-md-12 card shadow-none position-relative overflow-hidden m-0" style="background: var(--light-red)">
    <div class="card-body px-md-4 px-3 py-2">
        <div class="row align-items-center">
            <div class="col-md-9 col py-2">
                <h4 class="fw-semibold">Contact With Me</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item fw-semibold" aria-current="page">Contact With Me</li>
                    </ol>
                </nav>
            </div>
            <div class="col-3 d-md-block d-none">
                <div class="text-end mb-n4 me-n4">
                    <i class="menu-section-icon ti ti-file-phone"></i>
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
                    <h4 class="m-0">List Contact With Me</h4>
                </div>
                <table class="table table-bordered hover" id="listcontactwithme" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Message</th>
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
                <p id="desc-info">Are you sure, you want to Delete this Contact With Me?</p>
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
{{-- Modal Detail --}}
<div class="modal fade" id="viewDetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0">
            <div class="modal-header">
                <div class="col d-flex gap-2 align-items-center">
                    <i class="ti ti-info-square-rounded"></i>
                    <h6 class="modal-title ms-2" id="title-info">Detail Item</h6>
                </div>
            </div>
            <div class="modal-body py-1" style="overflow-x: hidden">
                <div class="card-body px-md-4 px-3 py-3">
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0 border-top">
                        <label class="col-md-3 text-md-end text-start control-label col-form-label" for="">Name</label>
                        <div class="col-md-9 input-field border-start pb-2 pt-md-2">
                            <input type="text" class="form-control" readonly id="name">
                        </div>
                    </div>
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0 border-top">
                        <label class="col-md-3 text-md-end text-start control-label col-form-label" for="">Contact Number</label>
                        <div class="col-md-9 input-field border-start pb-2 pt-md-2">
                            <input type="text" class="form-control" readonly id="contact_number">
                        </div>
                    </div>
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0 border-top">
                        <label class="col-md-3 text-md-end text-start control-label col-form-label" for="">Email</label>
                        <div class="col-md-9 input-field border-start pb-2 pt-md-2">
                            <input type="text" class="form-control" readonly id="email">
                        </div>
                    </div>
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0 border-top border-bottom">
                        <label class="col-md-3 text-md-end text-start control-label col-form-label" for="">Message</label>
                        <div class="col-md-9 input-field border-start pb-2 pt-md-2">
                            <textarea id="message"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex align-items-center justify-content-center border-0 gap-2 py-3">
                <button class="text-white" type="submit" style="font-size: 13px; background: var(--danger);" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    // List Contact With Me
    $(function() {
        $('#listcontactwithme').DataTable({
            scrollX: true,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.data_contact_with_me') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'contact_number',
                        name: 'contact_number'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'message',
                        name: 'message'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        class: 'text-center'
                    },
                ]
        });
    });
    function viewItem(id, name, contact_number, email, message) {
        $('#name').attr('value', name);
        $('#contact_number').attr('value', contact_number);
        $('#email').attr('value', email);
        tinymce.get("message").setContent(message).getBody().setAttribute('contenteditable', false);
    }
</script>
@endsection