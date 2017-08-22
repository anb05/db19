<div class="container" id="main">
    <div class="row" id="create-new-doc">
        <div class="col-md-3">
            <div class="left-aside">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h3 class="panel-title">Оберить тип запису</h3></div>
                    <div class="panel-body">
                        {!! $aside !!}
                        {{--@include('writer.aside_menu')--}}
                    </div>
                </div>
                {{--<ul class="nav nav-tabs nav-justified" role="tablist">--}}
                    {{--<li class="active" role="presentation">--}}
                        {{--<a href="#aside-tab1" aria-controls="aside-tab1" role="tab" data-toggle="tab">--}}
                            {{--@lang('ua.NoConfident')--}}
                        {{--</a>--}}
                    {{--</li>--}}

                    {{--<li role="presentation">--}}
                        {{--<a href="#aside-tab2" aria-controls="aside-tab2" role="tab" data-toggle="tab">--}}
                            {{--@lang('ua.Confident')--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}

                {{--<div class="tab-content">--}}
                    {{--<div role="tabpanel" class="tab-pane active context-panel" id="aside-tab1">--}}
                        {{--@include('writer.aside_menu')--}}
                    {{--</div> --}}{{-- End tab-pane active --}}

                    {{--<div role="tabpanel" class="tab-pane context-panel" id="aside-tab2">--}}
                        {{--@include('writer.aside_menu')--}}
                    {{--</div> --}}{{-- End tab-pane --}}
                {{--</div> --}}{{-- End tab-content --}}
            </div>  {{-- End left-aside --}}
        </div> {{-- End col-lg-4 --}}

        <div class="col-md-9">
            <div class="tabbable create-doc-panel">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#new-tab" data-toggle="tab">@lang('ua.newDocument')</a> </li>
                    <li><a href="#draft-tab" data-toggle="tab">@lang('ua.draftDocument')</a> </li>
                    <li><a href="#prepared-tab" data-toggle="tab">@lang('ua.preparedDocument')</a> </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active context-panel" id="new-tab">
                        @include('writer.form_create_doc')
                    </div> {{-- End tab-pane active --}}

                    <div class="tab-pane context-panel" id="draft-tab">
                        <h4>Перегляд чернеток</h4>
                    </div> {{-- End tab-pane --}}

                    <div class="tab-pane context-panel" id="prepared-tab">
                        <h4>перегляд підготовлених</h4>
                    </div> {{-- End tab-pane --}}
                </div> {{-- End tab-content --}}
            </div>

        </div> {{-- End col-lg-6 --}}
    </div>
</div> {{-- end Container --}}