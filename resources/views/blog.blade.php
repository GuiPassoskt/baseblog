@extends('layouts.blog')

@section('title', $post->title)

@section('excerpt', $post->excerpt)

@section('author')
    {{ $post->user->name }}
@stop

@section('cover', $post->url_cover_image)

@section('info')
{{ $post->user->name }}
<br>  <small>{{ $post->posted_at->format('d/m/Y \à\s H:i') }}</small>
@stop

@section('content')
    {!! $post->content !!}
@stop


