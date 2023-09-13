<div class="modal fade" id="changePassword" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <form action="{{ route('admin.store_change_password') }}" method="POST" id="form_change_password">
                @csrf
                <div class="modal-header">
                    <div class="col d-flex gap-2 align-items-center">
                        <i class="ti ti-key"></i>
                        <h6 class="modal-title ms-1" id="title-info">Change Password</h6>
                    </div>
                </div>
                <div class="modal-body text-center mt-1 mb-0 pt-2">
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0 border-top">
                        <label class="col-md-4 text-md-end text-start control-label col-form-label" for="">Old Password <span class="fs-4" style="color: crimson">*</span></label>
                        <div class="col-md-8 input-field border-start pb-2 pt-md-2">
                            <input type="password" class="form-control" name="old_password">
                            @error('old_password')
                                <small class="alert text-danger ps-0">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row flex-md-row flex-column align-items-center text-start mb-0 border-top border-bottom">
                        <label class="col-md-4 text-md-end text-start control-label col-form-label" for="">New Password <span class="fs-4" style="color: crimson">*</span></label>
                        <div class="col-md-8 input-field border-start pb-2 pt-md-2">
                            <input type="password" class="form-control" name="new_password">
                            @error('new_password')
                                <small class="alert text-danger ps-0">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex align-items-center justify-content-center border-0 gap-2 mb-2">
                    <button type="button" style="font-size: 13px" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    <button type="submit" style="font-size: 13px; background: var(--danger);">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>