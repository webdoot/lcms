@extends('lcms::layout')
@section('page_title', 'Post')

@push('head')
@endpush

@section('content')

<div class="card">
    <div class="card-header d-flex">
        <h5 class="mb-0">Show  &nbsp; <code>{{$post->code}}</code></h5>

        <a class="btn btn-sm btn-outline-primary d-inline-flex ms-auto" href="{{route('lcms_post.edit', $post->id)}}"> <i class="icon-pencil me-2"></i> Edit </a>
    </div>

    <div class="card-body mb-3">
        
        <div class="row border-bottom my-3">
            <div class="col">
                <label class="form-label fw-semibold">Title: </label>
                <code class="float-end">title</code>
                <h6>{{ $post->title }}</h6>
            </div>
        </div>

        <div class="row border-bottom mb-3">
            <div class="col">
                <label class="form-label fw-semibold">Sub Title: </label>
                <code class="float-end">sub_title</code>
                <h6>{{ $post->sub_title }}</h6>
            </div>
        </div>

        <div class="row border-bottom mb-3">
            <div class="col">
                <label class="form-label fw-semibold">Content: </label>
                <code class="float-end">content</code>
                {!! $post->content !!}
            </div>
        </div>

        <div class="row border-bottom mb-3">
            <div class="col">
                <label class="form-label fw-semibold">Media: </label>
                <code class="float-end">media</code>
                <div class="row g-3 mb-3">
                    @foreach($post->media as $m)
                    <div class="col-lg-2 col-md-3 col-4"> 
                        <img src="{{$m}}" class="img-fluid"> 
                    </div>
                    @endforeach
                </div>                
            </div>
        </div>

        <div class="row border-bottom mb-3">
            <div class="col">
                <label class="form-label fw-semibold">Meta: </label>
                <code class="float-end">meta</code>
                <table class="table">
                    @if(isset($post->meta) && count($post->meta))
                    @foreach($post->meta as $key => $val)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $val }}</td>
                    </tr>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>

        <div class="row border-bottom mb-3">
            <div class="col">
                <label class="form-label fw-semibold">Category: </label>
                <code class="float-end">category</code>
                <p>{{ $post->category->name }}</p>
            </div>
        </div>

    </div>
           
    
</div>

@endsection

@section('footer')
@endsection

@push('footer')
@endpush