@extends('back.layouts.master')
@section('title', 'Kategoriler')
@section('content')
    <div class="row">

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.category.create') }}">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Adı</label>
                            <input type="text" name="category" class="form-control" required />
                            <button type="submit" class="btn btn-primary btn-block mt-3">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kategoriler</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kategori Adı</th>
                                    <th>Makale Sayısı</th>
                                    <th>Durum</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->articleCount() }}</td>
                                        <td>
                                            <input data-onstyle="success" category-id="{{ $category->id }}" type="checkbox"
                                                class="switch" @if ($category->status) checked @endif
                                                data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <!-- Editle Butonu -->
                                            <a href="#" category-id={{ $category->id }} data-toggle="modal"
                                                data-target="#editModal" class="btn btn-warning btn-sm edit-click">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <!-- Sil Butonu -->
                                            <a href="" category-id={{ $category->id }}
                                                category-count={{ $category->articleCount() }} data-toggle="modal"
                                                data-target="#deleteModal" class="btn btn-danger btn-sm remove-click">
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
        </div>


        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.category.update') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Kategori Adı</label>
                                    <input type="text" name="category" class="form-control mb-2" id="modal-name"
                                        required />
                                    <label>Kategori Slugu</label>
                                    <input type="text" name="slug" class="form-control" id="modal-slug" required />
                                    <input type="hidden" name='id' id="modal-id" />
                                </div>

                                <button type="submit" class="btn btn-primary">Kaydet</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="articleAlert"></div>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('admin.category.delete') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Evet</button>
                            <input type="hidden" name='id' id="modal-id" class="hiddenInput" />
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır</button>
                    </div>
                </div>
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
            $('.edit-click').on("click", function() {
                id = $(this)[0].getAttribute('category-id');
                $.ajax({
                    type: 'GET',
                    url: "{{ route('admin.category.getdata') }}",
                    data: {
                        id: id
                    }
                }).done(function(data) {
                    $(".modal-title").text(data.name + ' kategorisini güncelle');
                    $("#modal-name").val(data.name);
                    $("#modal-slug").val(data.slug);
                    $("#modal-id").val(data.id);
                });
            });
            $('.remove-click').on("click", function() {
                $(".modal-title").text('Kategoriyi sil');
                id = $(this)[0].getAttribute('category-id');
                $(".hiddenInput").val(id);
                count = $(this)[0].getAttribute('category-count');
                articleAlert = $('.modal-body #articleAlert')
                if (id == 1) {
                    articleAlert.html('Genel kategorisi silinemez.')
                    $(".modal-footer").hide();
                } else if (count > 0) {
                    articleAlert.html('Bu kategoriye ait ' + count +
                        ' makale bulunmaktadır. Silmek istediğinize emin misiniz?')
                } else {
                    articleAlert.html('')
                }
                $('#deleteModal').modal()

            });
            $('.switch').change(function() {
                id = $(this)[0].getAttribute('category-id');
                $.get("{{ route('admin.category.switch') }}", {
                    id: id
                })
            })
        })
    </script>
@endsection
