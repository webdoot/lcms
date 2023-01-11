@extends('lcms::layout')
@section('page_title', 'Article')

@push('head')
@endpush

@section('content')

<div class="card">
    <div class="card-header d-flex">
        <h5 class="mb-0">Show</h5>

        <a class="btn btn-sm btn-outline-primary d-inline-flex ms-auto" href="{{route('lcms_article.edit', $article->id)}}"> <i class="icon-pencil me-2"></i> Edit </a>
    </div>

    <div class="card-body mb-3">
        
        <div class="row border-bottom my-3">
            <div class="col">
                <label class="form-label fw-semibold">Title: </label>
                <code class="float-end">title</code>
                <h6>{{ $article->title }}</h6>
            </div>
        </div>

        <div class="row border-bottom mb-3">
            <div class="col">
                <label class="form-label fw-semibold">Sub Title: </label>
                <code class="float-end">sub_title</code>
                <h6>{{ $article->sub_title }}</h6>
            </div>
        </div>

        <div class="row border-bottom mb-3">
            <div class="col">
                <label class="form-label fw-semibold">Label: </label>
                <code class="float-end">label</code>
                <p class="fw-semibold">{{ $article->label }}</p>
            </div>
        </div>

        <div class="row border-bottom mb-3">
            <div class="col">
                <label class="form-label fw-semibold">Content: </label>
                <code class="float-end">content</code>
                {!! $article->content !!}
            </div>
        </div>

        <div class="row border-bottom mb-3">
            <div class="col">
                <label class="form-label fw-semibold">Sub Content: </label>
                <code class="float-end">sub_content</code>
                {!! $article->sub_content !!}
            </div>
        </div>

        <div class="row border-bottom mb-3">
            <div class="col">
                <label class="form-label fw-semibold">Media: </label>
                <code class="float-end">media</code>
                <div class="row g-3 mb-3">
                    @foreach($article->media as $m)
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
                    @if(isset($article->meta) && count($article->meta))
                    @foreach($article->meta as $key => $val)
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
            <div class="col pb-2">
                @if($article->category)
                    <span class="fw-semibold">Category:</span> {{ $article->category->name }} <br>
                @endif
                @if(count($article->tags))
                    <span class="fw-semibold fst-italic">Tags:</span> 
                    @foreach($article->tags as $t)
                        @if(!$loop->last)
                            {{$t->name}},
                        @else
                            {{$t->name}}
                        @endif
                    @endforeach                                        
                @endif                 
            </div>
        </div>

    </div>
           
    
</div>

@endsection

@section('footer')
@endsection

@push('footer')
@endpush