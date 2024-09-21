@isset($categories)
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">Kategoriler</div>
            <ul class="list-group">
                @foreach ($categories as $category)
                    <li class="list-group-item @if (Request::segment(2) == $category->slug) bg-success text-danger @endif">
                        <a href="{{ route('category', $category->slug) }}"
                            class="@if (Request::segment(2) == $category->slug) text-light @endif">{{ $category->name }} <span
                                class="badge bg-success float-end">{{ $category->articleCount() }}</span></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endisset
