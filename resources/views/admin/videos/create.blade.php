@extends('layout.admin.app')
@section('content')

{{-- Breadcrumb --}}
<div class="col-md-12 card shadow-none position-relative overflow-hidden m-0" style="background: var(--light-red)">
    <div class="card-body px-md-4 px-3 py-2">
        <div class="row align-items-center">
            <div class="col-md-9 col py-2">
                <h4 class="fw-semibold">Videos</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('admin.dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('admin.videos') }}">
                                Videos
                            </a>
                        </li>
                        <li class="breadcrumb-item fw-semibold" aria-current="page">Create</li>
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
                <h5 class="fw-semibold">Create New Videos</h5>
                <a class="btn btn-primary d-flex align-items-center fs-2" href="{{ route('admin.videos') }}" role="button">
                    <i class="ti ti-arrow-left fs-5"></i>
                    <span class="d-md-block d-none ms-2">Back</span>
                </a>
            </div>
            <form class="form-horizontal r-separator" action="{{ route('admin.store_videos') }}" method="POST">
                @csrf
                <div class="card-body px-md-4 px-3 py-3">
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0 border-top">
                        <label class="col-md-3 text-md-end text-start control-label col-form-label" for="">Title <span class="fs-4" style="color: crimson">*</span></label>
                        <div class="col-md-9 input-field border-start pb-2 pt-md-2">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Title">
                            @error('title')
                                <small class="alert text-danger ps-0">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row flex-md-row flex-column align-items-center mb-0">
                        <label class="col-md-3 text-md-end text-start control-label col-form-label" for="">Video <span class="fs-4" style="color: crimson">*</span></label>
                        <div class="col-md-9 input-field border-start pb-2 pt-md-2">
                            <input type="url" class="form-control" name="video_link" value="{{ old('video_link') }}" placeholder="Video Link">
                            <small class="alert d-block pt-1 p-0 m-0">Only supports <strong class="text-danger">Youtube</strong> videos. e.g. <b><i>https://youtu.be/eRb6lymJOIM?si=5_jIT2ApP7z5sRKI</i></b></small>
                            @error('video_link')
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
    
</script>
@endsection