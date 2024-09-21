@extends('back.layouts.master')
@section('title', 'Silinen Makaleler')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ $articles->count() }} makale bulundu.</h6>
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


                                    <!-- Sil Butonu -->
                                    <a href="{{ route('admin.recover.article', $article->id) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fa fa-recycle"></i>
                                    </a>

                                    <!-- Geri Dönüşüm Butonu -->
                                    <a href="{{ route('admin.hard.delete.article', $article->id) }}"
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
@endsection
