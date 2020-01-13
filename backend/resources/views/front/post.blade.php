@extends('layouts.layout_index')
@section('title', env('SITE_NAME') . ' ' . $post['comment'] . ' ' .env('KEY_WORDS_PAGE'))
@section('description', $post['comment'].' '.$post['slug'] . ' ' . env('KEY_WORDS_VK'))
@section('keyword', env('KEY_WORDS_POST').' '.env('KEY_WORDS_VK'))
@section('header_text')
<h1><span class="h2">{{$post['comment']}}</span></h1>
<h2><span class="h4">Смотри видео: {{$post['comment']}} ВК <a class="text-white" style="text-decoration: underline;" onclick="yandexGoal(56860381,'HEADER_DESCRIPTION_LINK');" target="_blank" href="https://vk.com/fun_gifs_video_prikoly">GIFKAWOOD</a></span></h2>
@stop
@section('header_description', '')
@section('content')
    <div class="main main-raised" id="download">
        <div class="section section-basic">
            <div class="container p-0">
                <div class="title">
                    <a class="text-underline" href="/">назад</a>
                    <div class="video-flex d-flex flex-fill mt-3">
                        <div class="video-container mb-5">
                                @if(isset($post['files'][0]))
                                    <div style="display: none;" itemscope itemtype="http://schema.org/VideoObject" >
                                        <!--Указание типа объекта-->
                                        <a itemprop="url" href="{{env('FILE_STORAGE')}}{{$post['files'][0]['path']}}">
                                            <h1 itemprop="name">{{$post['comment']}} {{env('VK_NAME')}} {{env('KEY_WORDS_POST')}} {{env('KEY_WORDS_VK')}}</h1></a>
                                        <p itemprop="description">{{env('SITE_URL').' '.env('KEY_WORDS_POST').' '.$post['comment'] . ' ' .env('KEY_WORDS_POST_END')}}</p>
                                        <meta itemprop="duration" content="PT6M58S">
                                        <meta itemprop="isFamilyFriendly" content="true">
                                        <link itemprop="thumbnailUrl" href="{{env('APP_URL')}}/assets/img/video-preview.png"/>
                                        <p>Дата загрузки:<span itemprop="uploadDate">{{$post['created_at']}}</span></p>
                                        <span itemprop="thumbnail" itemscope itemtype="http://schema.org/ImageObject">
                                            <img itemprop="contentUrl" src="{{env('APP_URL')}}/assets/img/video-preview.png" alt="{{$post['comment']}}">
                                            <meta itemprop="width" content="250">
                                            <meta itemprop="height" content="120">
                                        </span>
                                    </div>
                                    <video width="100%" height="100%" controls="controls">
                                        <source src="{{env('FILE_STORAGE')}}{{$post['files'][0]['path']}}" type="video/mp4">
                                        Извините, ваш браузер не поддерживает встроенные видео,
                                        но не волнуйтесь, вы можете <a href="{{env('FILE_STORAGE')}}{{$post['files'][0]['path']}}">скачайте его</a>
                                        и смотреть его с вашим любимым видеоплеером!
                                    </video>
                                @endif
                        </div>
                    </div>
{{--                    <a class="text-underline" href="{{env('FILE_STORAGE')}}{{$post['files'][0]['path']}}" download target="_blank">Скачать файл</a>--}}
                </div>
            </div>
        </div>
    </div>
@stop
