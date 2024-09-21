@extends('back.layouts.master')
@section('title', 'Makale Oluştur')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.makaleler.store') }}">
                @csrf
                <div class="form-group">
                    <label>Makale Başlığı</label>
                    <input type="text" name="title" class="form-control" required></input>
                </div>
                <div class="form-group">
                    <label>Makale Kategori</label>
                    <select class="form-control" name="category">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Makale Fotoğrafı</label>
                    <input type="file" name="image" class="form-control" required></input>
                </div>
                <div class="form-group">
                    <label>Makale İçeriği</label>
                    <textarea id="editor" name="content" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Makaleyi Oluştur</button>
                </div>
            </form>
        </div>
    </div>


@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#editor').summernote({
                'height': 300
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
@endsection
