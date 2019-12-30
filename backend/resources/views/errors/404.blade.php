@extends('layouts.layout_index')
@section('title', 'ошибка 404 страница не найдена')
@section('header_text')
<h1>ошибка 404</h1>
@stop
@section('header_description')
<h3>запрашиваемая страница не найдена</h3>
@stop
@section('content')
    <div class="main main-raised" id="download">
        <div class="section section-basic">
            <div class="container">
                <div class="title">
                    <h2>Вернуться на <a style="color: #0a6ebd;text-decoration: underline" href="/">Главную</a></h2>
                </div>
            </div>
        </div>
    </div>
@stop
