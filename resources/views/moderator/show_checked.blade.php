@extends('layouts.app')

@section('main_head')
    @include('common.main_head')
@endsection

@section('main_menu')
    {!! $mainMenu !!}
@endsection

@section('content')

    <div class="container-fluid" id="main">
        <div class="row" id="view_prepareds">
            @if($leftAside)
                <div class="col-md-2">
                    <div class="left-aside">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Оберить тип запису</h3>
                            </div>

                            <div class="panel-body">

                                {!! $leftAside !!}

                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div
            @if($leftAside && $rightAside)
                {!! 'class="col-md-8"' !!}
                    @elseif($leftAside || $rightAside)
                {!! 'class="col-md-10"' !!}
                    @else
                {!! 'class="col-md-12"' !!}
                    @endif
            >
                <div class="create-doc-panel">

                    @if($bar)
                        {!! $bar !!}
                    @endif

                    <div class="tab-pane context-panel" role="tabpanel">

                        @if(!empty($view_checked))
                            {!! $view_checked !!}
                        @endif

                    </div>
                </div>
            </div>

            @if($rightAside)
                <div class="col-md-2">
                    <div class="right-aside">

                        {{ $rightAside }}

                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
