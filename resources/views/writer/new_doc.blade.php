<div class="container" id="main">
    <div class="row" id="create-new-doc">
        <div class="col-md-3">
            <div class="left-aside">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h3 class="panel-title">Оберить тип запису</h3></div>
                    <div class="panel-body">

                        {!! $aside !!}

                    </div>
                </div>
            </div>  {{-- End left-aside --}}
        </div> {{-- End col-md-3 --}}

        <div class="col-md-9">
            <div class="create-doc-panel">

                {!! $menu_panel !!}

                <div class="tab-content">
                    <div class="tab-pane active context-panel" id="new-tab" role="tabpanel">

                        {!! $form_create_doc !!}

                    </div> {{-- End tab-pane active --}}

                    <div class="tab-pane context-panel" id="draft-tab" role="tabpanel">
                        <h4>Перегляд чернеток</h4>
                    </div> {{-- End tab-pane --}}

                    <div class="tab-pane context-panel" id="prepared-tab" role="tabpanel">
                        <h4>перегляд підготовлених</h4>
                    </div> {{-- End tab-pane --}}

                    <div class="tab-pane context-panel" id="checked-tab" role="tabpanel">
                        <h4>перегляд перевірених</h4>
                    </div> {{-- End tab-pane --}}
                </div> {{-- End tab-content --}}
            </div>

        </div> {{-- End col-md-9 --}}
    </div>
</div> {{-- end Container --}}