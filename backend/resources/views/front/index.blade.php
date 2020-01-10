@extends('layouts.layout_index')
@section('title',  (isset($tag))?' категория видео '.$tag. ' ' .env('SITE_NAME'). ' ' .date('Y') : env('SITE_NAME'). ' ' .date('Y').' | '. env('KEY_WORDS'))
@section('description',  (isset($tag))?' категория видео ' .$tag . ' ' . env('SITE_NAME'):'лучшие видео приколы смешные свежие новинки самые топ смотреть интересные веселые животные котики')
@section('keyword', env('KEY_WORDS_POST').' '.env('KEY_WORDS_VK'))
@section('header_text')
<h1>{{isset($tag)?'Категория '.$tag:'GIFKAWOOD'}}</h1>
@stop
@section('header_description')
<h3>Смотри и скачивай лучшие видосы и гифки</h3>
<h4>Подпишись на группу VK <a class="text-white" style="text-decoration: underline;" onclick="yandexGoal(56860381,'HEADER_DESCRIPTION_LINK');" target="_blank" href="https://vk.com/fun_gifs_video_prikoly">GIFKAWOOD</a></h4>
@stop
@section('content')
    <div class="main main-raised download">
        <div class="section section-basic">
            <div class="container">
                <div class="title">
                    <h2>Наши видео VK <a onclick="yandexGoal(56860381,'CONTENT_VK_LINK');" target="_blank" href="https://vk.com/fun_gifs_video_prikoly" style="text-decoration: underline;">GIFKAWOOD</a></h2>
                </div>
                <!--  buttons -->
                <div id="buttons" class="cd-section mb-5 ">
                    <div class="row">
                        <div class="col-md-10">
                            @foreach ($tags as $key => $tag)
                                <a href="/tags/{{$tag['slug']}}" class="btn btn-{{$colors[$key]}}">{{$tag['name']}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{$posts->links()}}
                <div class="pt-2 col-sm-12 col-md-6">
                    @foreach ($posts as $post)
                        @if(isset($post['files'][0]))
                            <div style="box-shadow: 1px 2px 5px rgba(0,0,0,.2);border-radius: 10px;padding: 10px;" class="mb-5 video-flex d-flex flex-fill">
                                <div class="video-container mb-5">
                                    <a href="/post/{{$post['slug']}}"><h4 style="text-decoration: underline" class="h4 m-0"><span style="text-align: left">{{$post['comment']}}</span></h4></a>
                                    <video width="100%" height="100%" controls="controls">
                                        <source src="{{env('FILE_STORAGE')}}{{$post['files'][0]['path']}}" type="video/mp4">
                                        Извините, ваш браузер не поддерживает встроенные видео,
                                        но не волнуйтесь, вы можете <a href="{{env('FILE_STORAGE')}}{{$post['files'][0]['path']}}">скачайте его</a>
                                        и смотреть его с вашим любимым видеоплеером!
                                    </video>
                                </div>
                            </div>
                        <div style="display: none">{{$counter++}}</div>
                        @endif
                    @endforeach
                    @if($counter === 0)
                        <h2>В категории {{$tag['name']}} не найдено видео. вернуться на <a style="color: #0a6ebd;text-decoration: underline" href="/">Главную</a></h2>
                    @endif
                </div>
                {{$posts->links()}}
            </div>
        </div>
    </div>
@stop
