@extends('errors.errors_layouts.error')

@section('head')
    @include('errors.errors_layouts.error_head', ['title' => 'Error 404'])
@endsection

@section('content')
    @include('errors.errors_layouts.body404')
@endsection

@section('footer')
    @include('errors.errors_layouts.footer404')
@endsection
