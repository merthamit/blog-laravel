@extends('back.layouts.master')
@section('title', 'Ayarlar')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"> </h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('admin.config.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Site Başlığı</label>
                            <input type="text" name="title" required class="form-control" value="{{ $config->title }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Site Logo</label>
                            <input type="file" name="logo" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Site Favicon</label>
                            <input type="file" name="favicon" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" name="facebook" class="form-control" value="{{ $config->facebook }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Twitter</label>
                            <input type="text" name="twitter" class="form-control" value="{{ $config->twitter }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="text" name="instagram" class="form-control" value="{{ $config->instagram }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Github</label>
                            <input type="text" name="github" class="form-control" value="{{ $config->github }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Linkedin</label>
                            <input type="text" name="linkedin" class="form-control" value="{{ $config->linkedin }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Youtube</label>
                            <input type="text" name="youtube" class="form-control" value="{{ $config->youtube }}">
                        </div>
                    </div>
                    <div class="col-md-6 align-self-end">
                        <div class="form-group">
                            <label>Site Aktifliği</label>
                            <input data-onstyle="success" type="checkbox" class="switch form-control"
                                @if ($config->active) checked @endif data-toggle="toggle" data-onstyle="success"
                                data-offstyle="danger">
                        </div>
                    </div>
                    <div class="col mt-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100">Kaydet</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {
            $('.switch').change(function() {
                $.get("{{ route('admin.config.switch') }}")
            })
        })
    </script>
@endsection
