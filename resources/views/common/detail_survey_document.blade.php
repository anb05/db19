@extends('layouts.app')

@section('main_head')
    @include('common.main_head')
@endsection

@section('main_menu')
    {!! $mainMenu !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-offset-1 col-md-10">
                @if(session('error'))
                    <div class="alert alert-danger text-center">
                        {!! session('error') !!}
                    </div>
                @elseif(session('message'))
                    <div class="alert alert-success text-center">
                        {!! session('message') !!}
                    </div>
                @endif
            </div>
        </div>

        {!! $nativeTypeName !!}
        {!! $informationAboutControls !!}
        {!! $informationAboutResolutions !!}
        {!! $informationAboutDocument !!}
        {!! $viewingElectronicsCopies !!}
        {!! $bindWithGroups !!}

        @if(Auth::user()->role_name === 'moderator')
            {!! $moveTo !!}
        @endif
    </div>
@endsection
