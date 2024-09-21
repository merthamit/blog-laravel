@extends('back.layouts.master')
@section('title', 'Sayfalar')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pages->count() }} makale bulundu.</h6>
            {{-- <a href="{{ route('admin.trashed.page') }}" class="btn btn-warning">Silinen Makaleler</a> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sıralama</th>
                            <th>Fotoğraf</th>
                            <th>Sayfa Başlığı</th>
                            <th>Durum</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody id="orders">
                        @foreach ($pages as $page)
                            @php
                                $baseUrlUploads = url('/') . '\\' . $page->images;
                            @endphp
                            <tr id="page-{{ $page->id }}">
                                <td><i class="fa fa-arrows-alt-v handle fa-3x" style="cursor: move"></i></td>
                                <td><img src="{{ $baseUrlUploads }}" width="200" height="200" /></td>
                                <td>{{ $page->title }}</td>
                                <td>
                                    <input data-onstyle="success" page-id="{{ $page->id }}" type="checkbox"
                                        class="switch" @if ($page->status) checked @endif data-toggle="toggle"
                                        data-onstyle="success" data-offstyle="danger">
                                </td>

                                <td>
                                    <!-- Görüntüle Butonu -->
                                    <a href="{{ route('page', $page->slug) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <!-- Editle Butonu -->
                                    <a href="{{ route('admin.page.edit', $page->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Sil Butonu -->
                                    <a href="{{ route('admin.page.delete', $page->id) }}" class="btn btn-danger btn-sm">
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
                id = $(this)[0].getAttribute('page-id');
                $.get("{{ route('admin.page.switch') }}", {
                    id: id
                })
            })
        })
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

    <script>
        $('#orders').sortable({
            handle: '.handle',
            update: () => {
                var siralama = $('#orders').sortable('serialize')
                $.get("{{ route('admin.page.orders') }}?" + siralama, (data, status) => {
                    console.log(data)
                })
            }
        })
    </script>
@endsection
