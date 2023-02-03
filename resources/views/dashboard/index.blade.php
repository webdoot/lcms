@extends('lcms::layout')
@section('page_title', 'Dashboard')

@push('head')
@endpush

@section('content')

<div class="row">
    <div class="col-md-3">
        <a href="{{route('lcms_media.index')}}" class="text-muted">
            <div class="card card-body">
                <div class="d-flex align-items-center">
                    <i class="icon-images3 icon-2x"></i>

                    <div class="flex-fill text-end">
                        <h4 class="mb-0">{{ $media }}</h4>
                        <span class="text-primary fw-bold">Media</span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{route('lcms_article.index')}}" class="text-muted">
            <div class="card card-body">
                <div class="d-flex align-items-center">
                    <i class="icon-file-text2 icon-2x"></i>

                    <div class="flex-fill text-end">
                        <h4 class="mb-0">{{ $article }}</h4>
                        <span class="text-primary fw-semibold">Article</span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{route('lcms_menu.index')}}" class="text-muted">
            <div class="card card-body">
                <div class="d-flex align-items-center">
                    <i class="icon-list icon-2x"></i>

                    <div class="flex-fill text-end">
                        <h4 class="mb-0">{{ $menu }}</h4>
                        <span class="text-primary fw-semibold">Menu</span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{route('lcms_slider.index')}}" class="text-muted">
            <div class="card card-body">
                <div class="d-flex align-items-center">
                    <i class="icon-grid5 icon-2x"></i>

                    <div class="flex-fill text-end">
                        <h4 class="mb-0">{{ $slider }}</h4>
                        <span class="text-primary fw-semibold">Slider</span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{route('lcms_gallery.index')}}" class="text-muted">
            <div class="card card-body">
                <div class="d-flex align-items-center">
                    <i class="icon-gallery icon-2x"></i>

                    <div class="flex-fill text-end">
                        <h4 class="mb-0">{{ $gallery }}</h4>
                        <span class="text-primary fw-semibold">Gallery</span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{route('lcms_post.index')}}" class="text-muted">
            <div class="card card-body">
                <div class="d-flex align-items-center">
                    <i class="icon-stack2 icon-2x"></i>

                    <div class="flex-fill text-end">
                        <h4 class="mb-0">{{ $post }}</h4>
                        <span class="text-primary fw-semibold">Post</span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{route('lcms_category.index')}}" class="text-muted">
            <div class="card card-body">
                <div class="d-flex align-items-center">
                    <i class="icon-bookmark icon-2x"></i>

                    <div class="flex-fill text-end">
                        <h4 class="mb-0">{{ $category }}</h4>
                        <span class="text-primary fw-semibold">Category</span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{route('lcms_tag.index')}}" class="text-muted">
            <div class="card card-body">
                <div class="d-flex align-items-center">
                    <i class="icon-books icon-2x"></i>

                    <div class="flex-fill text-end">
                        <h4 class="mb-0">{{ $tag }}</h4>
                        <span class="text-primary fw-semibold">Tags</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card card-body pt-4 pb-5">
            <div class="d-flex">
                <div class="align-self-baseline bg-primary bg-opacity-10 text-primary rounded-pill p-2 me-3">
                    <i class="icon-help icon-2x"></i>
                </div>

                <div class="flex-fill">
                    <h4 class="mb-0">How to use?</h4>
                    <span class="text-muted"> Integration of content into template. </span>
                </div>
            </div>

            <div class="mt-3">
                <h5 class="mb-0">Article</h5>
                <p class="text-muted"> <strong> Lcms::get('code') </strong> </p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
@endsection

@push('footer')
@endpush