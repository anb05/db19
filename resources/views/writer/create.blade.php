@extends('layouts.app')

@section('main_head')
    @include('common.main_head')
@endsection

@section('main_menu')
    {!! $mainMenu !!}
@endsection

@section('content')
    @include('writer.new_doc')
@endsection
