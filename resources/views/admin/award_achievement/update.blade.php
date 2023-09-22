@extends('layout.admin.app')
@section('content')

{{-- Breadcrumb --}}
<div class="col-md-12 card shadow-none position-relative overflow-hidden m-0" style="background: var(--light-red)">
    <div class="card-body px-md-4 px-3 py-2">
        <div class="row align-items-center">
            <div class="col-md-9 col py-2">
                <h4 class="fw-semibold">Award & Achievements</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('admin.award_achievement') }}">
                                Award & Achievement
                            </a>
                        </li>
                        <li class="breadcrumb-item fw-semibold" aria-current="page">Update</li>
                    </ol>
                </nav>
            </div>
            <div class="col-3 d-md-block d-none">
                <div class="text-end mb-n4 me-n4">
                    <i class="menu-section-icon ti ti-folders"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between px-md-4 px-3 pb-0">
                <h5 class="fw-semibold">Update Award & Achievement</h5>
                <a class="btn btn-primary d-flex align-items-center fs-2" href="{{ route('admin.award_achievement') }}" role="button">
                    <i class="ti ti-arrow-left fs-5"></i>
                    <span class="d-md-block d-none ms-2">Back</span>
                </a>
            </div>
            <form class="form-horizontal r-separator" action="{{ route('admin.update_award_achievement', ['id' => $award_achievement->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body px-md-4 px-3 py-3">
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0 border-top">
                        <label class="col-md-3 text-md-end text-start control-label col-form-label" for="">Competition Name <span class="fs-4" style="color: crimson">*</span></label>
                        <div class="col-md-9 input-field border-start pb-2 pt-md-2">
                            <input type="text" class="form-control" name="competition_name" value="{{ $award_achievement->competition_name }}" placeholder="Competition Name">
                            @error('competition_name')
                                <small class="alert text-danger ps-0">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0">
                        <label class="col-md-3 text-md-end text-start control-label col-form-label" for="">Award Name <span class="fs-4" style="color: crimson">*</span></label>
                        <div class="col-md-9 input-field border-start pb-2 pt-md-2">
                            <input type="text" class="form-control" name="award_name" value="{{ $award_achievement->award_name }}" placeholder="Award Name">
                            @error('award_name')
                                <small class="alert text-danger ps-0">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0">
                        <label class="col-md-3 text-md-end text-start control-label col-form-label" for="">Image</label>
                        <div class="col-md-9 input-field border-start pb-2 pt-md-2">
                            <div class="col d-flex flex-md-row flex-column align-items-md-center align-items-start gap-md-4 gap-3">
                                <div class="col-md-9 col">
                                    <div class="input-group input-with-btn">
                                        <input class="form-control " type="file" id="image" name="image" onchange="previewImage()">
                                        <button class="btn btn-primary" type="button" id="clear_file" disabled>Clear File</button>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline mb-md-0 mb-2">
                                    <input class="form-check-input" type="checkbox" id="delete_img" name="delete_img" value="delete" {{ $award_achievement->image ? '' : 'disabled' }}>
                                    <label class="form-check-label fw-bolder" for="delete_img">Delete Image</label>
                                </div>
                            </div>
                            <div class="col {{ $award_achievement->image ? '' : 'd-none' }} d-flex justify-content-start mt-2" id="img_preview_box">
                                @if ($award_achievement->image)
                                    <img class="rounded" id="img_preview_data" src="{{ $award_achievement->image ? asset('uploaded_files/'.'award_achievement/'.$award_achievement->created_at->format('Y').'/'.$award_achievement->created_at->format('m').'/'.$award_achievement->image) : '' }}">
                                @endif
                                <img class="rounded d-none" id="img_preview">
                            </div>
                            @error('image')
                                <small class="alert text-danger ps-0">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0">
                        <label class="col-md-3 text-md-end text-start control-label col-form-label" for="">Alt</label>
                        <div class="col-md-9 input-field border-start pb-2 pt-md-2">
                            <input type="text" class="form-control" name="alt" value="{{ $award_achievement->alt }}" placeholder="Alt">
                            @error('alt')
                                <small class="alert text-danger ps-0">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0">
                        <label class="col-md-3 text-md-end text-start control-label col-form-label" for="">Competition Date</label>
                        <div class="col-md-3 input-field border-start pb-2 pt-md-2">
                            <input type="number" class="form-control" name="competition_date" value="{{ $award_achievement->competition_date ? date('Y', strtotime($award_achievement->competition_date)) : '' }}" placeholder="YYYY" min="1999">
                            @error('competition_date')
                                <small class="alert text-danger ps-0">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="p-3 pt-0">
                    <div class="mb-0 text-center">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    function previewImage(){
        const image = document.querySelector('#image')
        const imgPreview = document.querySelector('#img_preview')
        $("#img_preview_box").removeClass("d-none")
        $("#img_preview_data").addClass("d-none")
        $("#img_preview").removeClass("d-none")
        $('#clear_file').prop("disabled", false)
        const oFReader = new FileReader()
        oFReader.readAsDataURL(image.files[0])
        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result
        }
    };

    // Clear File
    $('#clear_file').on('click', function() {
        $('#clear_file').prop("disabled", true)
        $('#image').val(null)
        $("#img_preview_data").removeClass("d-none")
        $("#img_preview").attr('src', '')
    });

    // Delete Image
    $('#delete_img').on('change', function() {
        if ($('#delete_img').is(":checked")) {
            $('#img_preview_box').addClass('d-none')
            $('#clear_file').prop("disabled", true)
            $('#image').val(null)
        } else {
            $('#img_preview_box').removeClass('d-none')
        }
    });
</script>
@endsection