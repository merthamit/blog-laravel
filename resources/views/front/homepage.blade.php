@extends('front.layouts.master')
@section('title', 'Anasayfa')
@section('content')

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-9 col-xl-7">
                @isset($articles)
                    @include('front.widgets.articleList')
                @endisset
                <!-- Pager-->
                <div class="d-flex justify-content-end mb-4">
                    <a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a>
                </div>
            </div>
            @include('front.widgets.categoryWidget')

        </div>
    </div>
@endsection
