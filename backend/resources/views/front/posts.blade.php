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
                    <div style="display: none;" itemscope itemtype="http://schema.org/VideoObject" >
                        <!--Указание типа объекта-->
                        <a itemprop="url" href="{{env('FILE_STORAGE')}}{{$post['files'][0]['path']}}">
                            <h1 itemprop="name">{{$post['comment']}} {{env('VK_NAME')}} {{env('KEY_WORDS_POST')}} {{env('KEY_WORDS_VK')}}</h1></a>
                        <p itemprop="description">{{env('SITE_URL').' '.env('KEY_WORDS_POST').' '.$post['comment'] . ' ' .env('KEY_WORDS_POST_END')}}</p>
                        <meta itemprop="duration" content="PT6M58S">
                        <meta itemprop="isFamilyFriendly" content="true">
                        <p>Дата загрузки:<span itemprop="uploadDate">{{$post['created_at']}}</span></p>
                        <span itemprop="thumbnail" itemscope itemtype="http://schema.org/ImageObject">
                                    <img itemprop="contentUrl" src="{{env('APP_URL')}}/assets/img/video-preview.png">
                                    <meta itemprop="width" content="250">
                                    <meta itemprop="height" content="120">
                                </span>
                    </div>
                    <a href="{{$post['link']}}">{{$post['link']}}</a><br>
                @endforeach
            </div>
        </div>
    </div>
@stop
