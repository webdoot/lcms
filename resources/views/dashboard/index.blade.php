@extends('lcms::layout')
@section('page_title', 'Dashboard')

@push('head')
@endpush

@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <i class="icon-images3 icon-2x"></i>

                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ $media }}</h4>
                    <span class="text-muted fw-semibold">Media</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <i class="icon-file-text2 icon-2x"></i>

                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ $article }}</h4>
                    <span class="text-muted fw-semibold">Article</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <i class="icon-list icon-2x"></i>

                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ $menu }}</h4>
                    <span class="text-muted fw-semibold">Menu</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <i class="icon-grid5 icon-2x"></i>

                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ $slider }}</h4>
                    <span class="text-muted fw-semibold">Slider</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <i class="icon-gallery icon-2x"></i>

                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ $gallery }}</h4>
                    <span class="text-muted fw-semibold">Gallery</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <i class="icon-stack2 icon-2x"></i>

                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ $post }}</h4>
                    <span class="text-muted fw-semibold">Post</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <i class="icon-bookmark icon-2x"></i>

                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ $category }}</h4>
                    <span class="text-muted fw-semibold">Category</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <i class="icon-books icon-2x"></i>

                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ $tag }}</h4>
                    <span class="text-muted fw-semibold">Tags</span>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col">
        <div class="card card-body">
            <div class="d-flex align-items-center align-items-lg-start flex-column flex-lg-row">
                <div class="bg-primary bg-opacity-10 text-primary lh-1 rounded-pill p-2 me-lg-3 mb-3 mb-lg-0">
                    <i class="icon-help icon-2x"></i>
                </div>

                <div class="flex-fill text-center text-lg-start">
                    <h4 class="mb-0">How to use?</h4>
                    <span class="text-muted">Laravel Content Management System</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
@endsection

@push('footer')
@endpush