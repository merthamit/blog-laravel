@extends('front.layouts.master')
@section('title', $article->title)
@section('bg', $article->image)
@section('content')
    <!-- Post Content-->
    <article class="mb-4">
        <div class="row container mx-auto">
            <div class="col-md-9 ">
                <h2 class="title">{{ $article->title }}</h2>

                @php
                    $baseUrlUploads = url('/') . '\\' . $article->image;
                @endphp
                <img src="{{ $baseUrlUploads }}" class="w-100 mb-4 object-cover" />
                <div class="w-100" style="word-wrap: break-word;">{!! $article->content !!}</div>
                <span class="d-block mt-4 "><b>Okunma sayısı:</b> {{ $article->hit }}</span>
            </div>
            @include('front.widgets.categoryWidget')
        </div>
    </article>
@endsection
