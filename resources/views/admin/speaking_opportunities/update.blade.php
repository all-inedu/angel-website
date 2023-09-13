@extends('layout.admin.app')
@section('content')

{{-- Breadcrumb --}}
<div class="col-md-12 card shadow-none position-relative overflow-hidden m-0" style="background: var(--light-red)">
    <div class="card-body px-md-4 px-3 py-2">
        <div class="row align-items-center">
            <div class="col-md-9 col py-2">
                <h4 class="fw-semibold">Speaking Opportunities</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('admin.speaking_opportunities') }}">
                                Speaking Opportunities
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
                <h5 class="fw-semibold">Update Speaking Opportunities</h5>
                <a class="btn btn-primary d-flex align-items-center fs-2" href="{{ route('admin.speaking_opportunities') }}" role="button">
                    <i class="ti ti-arrow-left fs-5"></i>
                    <span class="d-md-block d-none ms-2">Back</span>
                </a>
            </div>
            <form class="form-horizontal r-separator" action="{{ route('admin.update_speaking_opportunities', ['id' => $speaking_opportunities->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body px-md-4 px-3 py-3">
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0 border-top">
                        <label class="col-md-3 text-md-end text-start control-label col-form-label" for="">Title <span class="fs-4" style="color: crimson">*</span></label>
                        <div class="col-md-9 input-field border-start pb-2 pt-md-2">
                            <input type="text" class="form-control" name="title" value="{{ $speaking_opportunities->title }}" placeholder="Title">
                            @error('title')
                                <small class="alert text-danger ps-0">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0">
                        <label class="col-md-3 text-md-end text-start control-label col-form-label" for="">Image/Video <span class="fs-4" style="color: crimson">*</span></label>
                        <div class="col-md-9 input-field border-start pb-2 pt-md-2">
                            <div class="col d-flex gap-3">
                                <label class="col-form-label p-0">Choose:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="imageVideoOption" id="imageOption" value="" onchange="optionInput()" {{ $speaking_opportunities->image ? 'checked' : '' }}>
                                    <label class="col-form-label p-0" for="imageOption">
                                        Image
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="imageVideoOption" id="videoOption" value="" onchange="optionInput()" {{ $speaking_opportunities->video_link ? 'checked' : '' }}>
                                    <label class="col-form-label p-0" for="videoOption">
                                        Video
                                    </label>
                                </div>
                            </div>
                            {{-- Image --}}
                            <div class="col mt-2 {{ $speaking_opportunities->image ? '' : 'd-none' }}" id="image_input">
                                <input class="form-control" type="file" id="image" name="image" onchange="previewImage()">
                                <div class="col d-flex justify-content-start mt-1" id="img_preview_box">
                                    <img class="rounded" id="img_preview" src="{{ $speaking_opportunities->image ? asset('uploaded_files/'.'speaking_opportunities/'.$speaking_opportunities->created_at->format('Y').'/'.$speaking_opportunities->created_at->format('m').'/'.$speaking_opportunities->image) : '' }}">
                                </div>
                                @error('image')
                                    <small class="alert text-danger ps-0">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- Video --}}
                            <div class="col mt-2 {{ $speaking_opportunities->video_link ? '' : 'd-none' }}" id="video_input">
                                <input type="url" class="form-control" name="video_link" value="{{ $speaking_opportunities->video_link }}" placeholder="Video Link">
                                <small class="alert d-block pt-1 p-0 m-0">Only supports <strong class="text-danger">Youtube</strong> videos. e.g. <b><i>https://youtu.be/eRb6lymJOIM</i></b></small>
                                @error('video_link')
                                    <small class="alert text-danger ps-0">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0">
                        <label class="col-md-3 text-md-end text-start control-label col-form-label" for="">Alt <span class="fs-4" style="color: crimson">*</span></label>
                        <div class="col-md-9 input-field border-start pb-2 pt-md-2">
                            <input type="text" class="form-control" name="alt" value="{{ $speaking_opportunities->alt }}" placeholder="Alt">
                            @error('alt')
                                <small class="alert text-danger ps-0">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0">
                        <label class="col-md-3 text-md-end text-start control-label col-form-label" for="">Description <span class="fs-4" style="color: crimson">*</span></label>
                        <div class="col-md-9 input-field border-start pb-2 pt-md-2">
                            <textarea name="description">
                                {{ $speaking_opportunities->description }}
                            </textarea>
                            @error('description')
                                <small class="alert text-danger ps-0">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0">
                        <label class="col-md-3 text-md-end text-start control-label col-form-label" for="">Event Date</label>
                        <div class="col-md-3 input-field border-start pb-2 pt-md-2">
                            <input type="month" class="form-control" name="event_date" value="{{ $speaking_opportunities->event_date ? date('Y-m', strtotime($speaking_opportunities->event_date)) : '' }}">
                            @error('event_date')
                                <small class="alert text-danger ps-0">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="p-3 pt-0">
                    <div class="mb-0 text-center">
                        <button type="submit" class="btn btn-info rounded-pill px-4">
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
    function optionInput(){
        if ($('#imageOption').is(':checked')){ 
            // Image
            $('#image_input').removeClass('d-none');
            if (!$('#video_input').hasClass('d-none')) {
                $('#video_input').addClass('d-none')
            }
        } else if ($('#videoOption').is(':checked')){
            // Video
            $('#video_input').removeClass('d-none');
            if (!$('#image_input').hasClass('d-none')) {
                $('#image_input').addClass('d-none')
            }
        }
    }
    function previewImage(){
        const image = document.querySelector('#image')
        const imgPreview = document.querySelector('#img_preview')
        const oFReader = new FileReader()
        oFReader.readAsDataURL(image.files[0])
        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result
        }
    };
</script>
@endsection