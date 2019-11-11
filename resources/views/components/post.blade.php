
<div class="blog">
    <div class="image" style="
    background: url('{{ $post->url_cover_image }}');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;">
        <div class="block">
            <div class="description">{{ $post->title }}</div>
            <div class="description">{{ $post->title }}</div>
        </div>
    </div>
    <div class="action">
        <a class="btn" href="{{ $post->url }}">CONFERIR</a>
    </div>
</div>