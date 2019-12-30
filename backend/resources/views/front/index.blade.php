@extends('layouts.layout_index')
@section('title', ' GIFKAWOOD '.date('Y').' | скачать смотреть лучшие новинки гиф и видео приколы бесплатно. Download watch gifs and video jokes for free.')
@section('description', 'лучшие видео приколы смешные свежие новинки самые топ смотреть интересные веселые животные котики')
@section('header_text', 'GIFKAWOOD')
@section('header_description', 'Смотри и скачивай лучшие видосы и гифки')
@section('content')
    <div class="main main-raised" id="download">
        <div class="section section-basic">
            <div class="container">
                <div class="title">
                    <h2>Наши видео</h2>
                </div>
                <!--  buttons -->
                <div id="buttons" class="cd-section">
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

                @foreach ($posts as $post)
                    <div class="video-flex d-flex flex-fill">
                        <div class="video-container mb-5">
                            <h4 class="h4">{{$post['comment']}}</h4>
                            <video width="300" height="200" controls="controls">
                                <source src="{{env('FILE_STORAGE')}}{{$post['files'][0]['path']}}" type="video/mp4">
                                Извините, ваш браузер не поддерживает встроенные видео,
                                но не волнуйтесь, вы можете <a href="{{env('FILE_STORAGE')}}{{$post['files'][0]['path']}}">скачайте его</a>
                                и смотреть его с вашим любимым видеоплеером!
                            </video>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@stop
