@extends('lcms::layout')
@section('page_title', 'Dashboard')

@push('head')
@endpush

@section('content')

<div class="card">
    <div class="card-header d-flex">
        <h5 class="mb-0">Dashboard</h5>

        <a type="button" class="btn btn-sm btn-primary ms-auto" href="{{route('lcms_article.create')}}"> <i class="icon-plus2 me-2"></i> Add </a>
    </div>

    <div class="card-body">
        <form action="{{route('lcms_media.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="ufile">
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
           
    
</div>

@endsection

@section('footer')
@endsection

@push('footer')
@endpush