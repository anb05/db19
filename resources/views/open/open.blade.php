@extends('layouts.app')

@section('main_head')
    @include('common.main_head')
@endsection

@section('main_menu')
    {!! $mainMenu !!}
@endsection

@section('content')
    {!! "<h1> Відкриті джерела</h1>" !!}
    {!! "<a href='/open/mp_main/index.html'>Методичні рекомендації Яблукової</a>" !!}
@endsection