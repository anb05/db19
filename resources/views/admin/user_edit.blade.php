@extends('layouts.app')

@section('main_head')
    @include('common.main_head')
@endsection

@section('content')
    @if($oldUserData)

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form class="form-horizontal" method="POST" action="{{ route('userEdit', ['user' => $oldUserData['id']]) }}">
                        {{ csrf_field() }}

                        <div class="panel panel-default">
                            <div class="panel-heading">@lang('ua.User data for the application')</div>
                            <div class="panel-body">

                                <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                                    <label for="id" class="col-md-4 control-label">{{ trans('ua.id') }}</label>

                                    <div class="col-md-6">
                                        <input id="id" type="text" class="form-control" name="id" value="{{ $oldUserData['id'] }}" disabled>

                                        @if ($errors->has('id'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                                    <label for="login" class="col-md-4 control-label">{{ trans('ua.Login') }}</label>

                                    <div class="col-md-6">
                                        <input id="login" type="text" class="form-control" name="login" value="{{ $oldUserData['login'] }}" disabled>

                                        @if ($errors->has('login'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">@lang('ua.Password')</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 control-label">@lang('ua.Confirm Password')</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>

                            </div>

                            @if(!empty($userDataFromDB))
                                {!! $userDataFromDB !!}
                            @endif

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ trans('ua.Change') }}
                                    </button>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('main_menu')
    {!! $mainMenu !!}
@endsection
