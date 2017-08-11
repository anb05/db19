@extends('layouts.app')

@section('main_head')
    @include('common.main_head')
@endsection

@section('status')
    @if (session('status'))
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="alert alert-success">
                        {!! session('status') !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('main_menu')
    {!! $mainMenu !!}
@endsection

@section('content')
    @include('admin.content')
@endsection
