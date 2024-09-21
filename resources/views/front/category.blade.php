@extends('front.layouts.master')
@section('title', $category->name)
@section('content')
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-9 col-xl-7">
                @if (count($articles))
                    @include('front.widgets.articleList')
                    <!-- Pager-->
                    <div class="d-flex justify-content-end mb-4">
                        <a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a>
                    </div>
                @else
                    <div class="alert alert-danger  d-block mb-5">
                        <h3 class="text-center">Kategoride henüz bir blog yok.</h3>
                    </div>
                @endif
            </div>
            @include('front.widgets.categoryWidget')
        </div>
    </div>
@endsection
