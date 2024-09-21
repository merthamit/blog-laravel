@extends('back.layouts.master')
@section('title', 'Makaleler')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ $articles->count() }} makale bulundu.</h6>
            <a href="{{ route('admin.trashed.article') }}" class="btn btn-warning">Silinen Makaleler</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Fotoğraf</th>
                            <th>Makale Başlığı</th>
                            <th>Kategori</th>
                            <th>Görüntülenme Sayısı</th>
                            <th>Oluşturulma Tarihi</th>
                            <th>Durum</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                            @php
                                $baseUrlUploads = url('/') . '\\' . $article->image;
                            @endphp
                            <tr>
                                <td><img src="{{ $baseUrlUploads }}" width="200" height="200" /></td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->getCategory->name }}</td>
                                <td>{{ $article->hit }}</td>
                                <td>{{ $article->created_at }}</td>
                                <td>
                                    <input data-onstyle="success" article-id="{{ $article->id }}" type="checkbox"
                                        class="switch" @if ($article->status) checked @endif data-toggle="toggle"
                                        data-onstyle="success" data-offstyle="danger">
                                </td>

                                <td>
                                    <!-- Görüntüle Butonu -->
                                    <a href="{{ route('single', [$article->getCategory->slug, $article->slug]) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <!-- Editle Butonu -->
                                    <a href="{{ route('admin.makaleler.edit', $article->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Sil Butonu -->
                                    <a href="{{ route('admin.delete.article', $article->id) }}"
                                        class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
                id = $(this)[0].getAttribute('article-id');
                $.get("{{ route('admin.switch') }}", {
                    id: id
                })
            })
        })
    </script>
@endsection
