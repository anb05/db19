@extends('layouts.app')

@section('main_head')
    @include('common.main_head')
@endsection

@section('main_menu')
    {!! $mainMenu !!}
@endsection

@section('content')

    <div class="container-fluid" id="main">
        <div class="row" id="view_drafts">
            <div class="col-md-2">
                <div class="left-aside">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Оберить тип запису</h3>
                        </div>

                        <div class="panel-body">

                            {!! $aside !!}

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-10">
                <div class="create-doc-panel">

                    {!! $menu_panel !!}

                    <div class="tab-pane context-panel" role="tabpanel">

                        {!! $view_drafts !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
