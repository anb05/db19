@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">

                    Dashboard

                    @if (session('status'))
                        <div class="alert alert-success" style="display: inline-block">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>

                <div class="panel-body">
                    <ul class="btn-group" role="group">
                        <li class="btn btn-default">
                            <a href="{{ route('register') }}">
                                New User
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
