@extends('layouts.layout_index')
@section('title',  env('SITE_NAME_MOREGIRLS').' '.env('SITE_TITLE_MOREGIRLS'))
@section('description',  env('SITE_NAME_MOREGIRLS').' '.env('KEY_WORDS_POST_END').' '.env('KEY_WORDS_MOREGIRLS').' '.env('KEY_WORDS_POST'))
@section('keyword', env('KEY_WORDS_MOREGIRLS_SITE').' '.env('KEY_WORDS_BEST_MOREGIRLS'))
@section('header_text')
<h1>{{env('SITE_NAME_MOREGIRLS')}}</h1>
@stop
@section('header_description')
<h2 class="h3">Самые горячие девушки тут</h2>
<h4>Подпишись на группу VK <a class="text-white" style="text-decoration: underline;" target="_blank" href="{{env('VK_LINK_MOREGIRLS')}}">MOREGIRLS</a></h4>
@stop
@section('content')
    <div class="main main-raised download">
        <div class="section section-basic">
            <div class="container">
                <div class="title">
                    <h2>Наши видео VK <a target="_blank" href="{{env('VK_LINK_MOREGIRLS')}}" style="text-decoration: underline;">MOREGIRLS</a></h2>
                </div>
                {{$posts->links()}}
                <div class="pt-2 col-sm-12 col-md-6">
                    @foreach ($posts as $post)
                        @if(isset($post['files'][0]))
                            <div style="box-shadow: 1px 2px 5px rgba(0,0,0,.2);border-radius: 10px;padding: 10px;" class="mb-5 video-flex d-flex flex-fill">
                                <div class="video-container mb-5">
                                    <a href="/moregirls/{{$post['slug']}}"><h3 style="text-decoration: underline" class="h4 m-0"><span style="text-align: left">{{$post['comment']}}</span></h3></a>
                                    <video width="100%" height="100%" controls="controls">
                                        <source src="{{env('FILE_STORAGE')}}{{$post['files'][0]['path']}}" type="video/mp4">
                                        Извините, ваш браузер не поддерживает встроенные видео,
                                        но не волнуйтесь, вы можете <a href="{{env('FILE_STORAGE')}}{{$post['files'][0]['path']}}">скачайте его</a>
                                        и смотреть его с вашим любимым видеоплеером!
                                    </video>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                {{$posts->links()}}
            </div>
        </div>
    </div>
@stop
