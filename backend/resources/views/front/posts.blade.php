@extends('layouts.layout_index')
@section('title', env('SITE_NAME').' Список всех постов с видео ' .env('KEY_WORDS'))
@section('header_text')
<h1><span class="h2">Список всех постов</span></h1>
@stop
@section('header_description', '')
@section('content')
    <div class="main main-raised" id="download">
        <div class="section section-basic">
            <div class="container p-0">
                @foreach($posts as $post)
                    <a href="{{$post['link']}}">{{$post['link']}}</a><br>
                @endforeach
            </div>
        </div>
    </div>
@stop
