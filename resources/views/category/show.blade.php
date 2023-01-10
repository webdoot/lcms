@extends('lcms::layout')
@section('page_title', 'Category')

@push('head')
@endpush

@section('content')

<div class="card">
    <div class="card-header d-flex">
        <h5 class="mb-0">Show</h5>

        <a class="btn btn-sm btn-outline-primary d-inline-flex ms-auto" href="{{route('lcms_category.edit', $category->id)}}"> <i class="icon-pencil me-2"></i> Edit </a>
    </div>

    <div class="card-body mb-3">
        
        <div class="row border-bottom my-3">
            <div class="col">
                <label class="form-label fw-semibold">Name: </label>
                <code class="float-end">name</code>
                <h6>{{ $category->name }}</h6>
            </div>
        </div>

        <div class="row border-bottom mb-3">
            <div class="col">
                <label class="form-label fw-semibold">Description: </label>
                <code class="float-end">description</code>
                <h6>{{ $category->description }}</h6>
            </div>
        </div>
    </div>
           
    
</div>

@endsection

@section('footer')
@endsection

@push('footer')
@endpush