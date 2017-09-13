<div class="container-fluid" id="main">
    <div class="row" id="create-new-doc">
        <div class="col-md-2">
            <div class="left-aside">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h3 class="panel-title">Оберить тип запису</h3></div>
                    <div class="panel-body">

                        {!! $aside !!}

                    </div>
                </div>
            </div>  {{-- End left-aside --}}
        </div> {{-- End col-md-3 --}}

        <div class="col-md-10">
            <div class="create-doc-panel">

                {!! $menu_panel !!}

                <div class="tab-pane context-panel" role="tabpanel">

                    {!! $form_create_doc !!}

                </div>  {{-- End tab-pane active --}}
            </div>

        </div> {{-- End col-md-9 --}}
    </div>
</div> {{-- end Container --}}