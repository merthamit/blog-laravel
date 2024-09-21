@foreach ($articles as $article)
    <!-- Post preview-->
    <div class="post-preview mb-6">
        <a href="{{ route('single', [$article->getCategory->slug, $article->slug]) }}">
            <h2 class="post-title mt-0">
                {{ $article->title }}
            </h2>
            <img src="{{ $article->image }}" class="w-100" style="height:200px; object-fit:cover" />
            <h3 class="post-subtitle" style="word-wrap: break-word;">
                {!! str_limit($article->content, 70) !!}
            </h3>
        </a>
        <p class="post-meta"> Kategori:
            <a href="#!">{{ $article->getCategory->name }}</a>
            <span
                class="float-end">{{ \Carbon\Carbon::parse($article->created_at)->locale('tr')->diffForHumans() }}</span>
        </p>
    </div>
    @if (!$loop->last)
        <!-- Divider-->
        <hr class="my-4" />
    @endif
    <!-- Post preview-->
@endforeach
{{ $articles->links() }}
