@extends('layouts.layout_index')
@section('title', '123')
@section('header_text', 'header_text')
@section('header_description', 'header_description')
@section('content')
    <div class="main main-raised" id="download">
        <div class="section section-basic">
            <div class="container">
                <div class="title">
                    <h2>Страница поста</h2>
                    {{--{{ route('post.index') }}--}}
                </div>
            </div>
        </div>
    </div>
@stop
