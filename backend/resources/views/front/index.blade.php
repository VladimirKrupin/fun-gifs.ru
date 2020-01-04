@extends('layouts.layout_index')
@section('title', env('SITE_NAME'). ' ' .date('Y').' | '. env('KEY_WORDS'))
@section('description', 'лучшие видео приколы смешные свежие новинки самые топ смотреть интересные веселые животные котики')
@section('header_text')
<h1>GIFKAWOOD</h1>
@stop
@section('header_description')
<h3>Смотри и скачивай лучшие видосы и гифки</h3>
<h4>Подпишись на группу VK <a target="_blank" class="text-white" style="text-decoration: underline;" href="{{env('VK_LINK')}}">GIFKAWOOD</a></h4>
@stop
@section('content')
    <div class="main main-raised download">
        <div class="section section-basic">
            <div class="container">
                <div class="title">
                    <h2>Наши видео VK <a target="_blank" style="text-decoration: underline;" href="{{env('VK_LINK')}}">GIFKAWOOD</a></h2>
                </div>
                <!--  buttons -->
                <div id="buttons" class="cd-section mb-5 ">
                    <div class="title">
                        <h3>
                            <small> По категориям (в разработке...)</small>
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <button class="btn">Смешное</button>
                            <button class="btn btn-primary">Кошки</button>
                            <button class="btn btn-info">Девушки</button>
                            <button class="btn btn-success">Неловковышло</button>
                            <button class="btn btn-warning">Шокирующие</button>
                            <button class="btn btn-danger">Красота</button>
                            <button class="btn btn-rose">Лайфхак</button>
                        </div>
                    </div>
                </div>
                {{$posts->links()}}
                <div class="pt-2 col-sm-12 col-md-6">
                    @foreach ($posts as $post)
                        @if(isset($post['files'][0]))
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
                        @endif
                    @endforeach
                </div>
                {{$posts->links()}}
            </div>
        </div>
    </div>
@stop
