@extends('layouts.app')

@section('main_head')
    @include('common.main_head')
    <link href="{{ asset('css/background.css') }}" rel="stylesheet">
@endsection

@section('status')
    @if (session('status'))
        <div class="alert alert-success" style="display: inline-block; height: 21px; margin: 0; padding: 0;">
            {{ session('status') }}
        </div>
    @endif
@endsection

@section('content')
    @include('admin.content')
@endsection

@section('main_menu')
    {!! $mainMenu !!}
@endsection


