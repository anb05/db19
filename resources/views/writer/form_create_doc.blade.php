<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="tab-content">
        <div class="tab-pane active" id="select-input-no-conf">
            <div class="row tabbable add-space-top">
                <div class="col-sm-3">
                    <label for="no_confidential_number" class="control-label">@lang('ua.no_confidential_number'):</label>
                </div>

                <div class="col-sm-3">
                    <input id="no_confidential_number" class="form-control" name="no_confidential_number">
                </div>

                <div class="col-sm-3">
                    <label for="no_confidential_number_date" class="control-label">@lang('ua.no_confidential_number_date'):</label>
                </div>

                <div class="col-sm-3">
                    <input id="no_confidential_number_date" class="form-control" name="no_confidential_number_date" type="date">
                </div>
            </div>

            <div class="row add-space-top">
                <div class="col-sm-3">
                    <label for="outside_serial" class="control-label">@lang('ua.outside_serial'):</label>
                </div>

                <div class="col-sm-3">
                    <input id="outside_serial" class="form-control" name="outside_serial">
                </div>

                <div class="col-sm-3">
                    <label for="outside_date" class="control-label">@lang('ua.outside_date'):</label>
                </div>

                <div class="col-sm-3">
                    <input id="outside_date" class="form-control" name="outside_date" type="date">
                </div>
            </div>
        </div>

        <div class="tab-pane" id="select-output-no-conf">
            <div class="row tabbable add-space-top">
                <div class="col-sm-3">
                    <label for="no_confidential_output" class="control-label">@lang('ua.no_confidential_output'):</label>
                </div>

                <div class="col-sm-3">
                    <input id="no_confidential_output" class="form-control" name="no_confidential_output">
                </div>

                <div class="col-sm-3">
                    <label for="no_confidential_output_date" class="control-label">@lang('ua.no_confidential_output_date'):</label>
                </div>

                <div class="col-sm-3">
                    <input id="no_confidential_output_date" class="form-control" name="no_confidential_output_date" type="date">
                </div>
            </div>
        </div>

        <div class="tab-pane" id="select-inventory-no-conf">
            <div class="row tabbable add-space-top">
                <div class="col-sm-3">
                    <label for="no_confidential_inventory" class="control-label">@lang('ua.no_confidential_inventory'):</label>
                </div>

                <div class="col-sm-3">
                    <input id="no_confidential_inventory" class="form-control" name="no_confidential_inventory">
                </div>

                <div class="col-sm-3">
                    <label for="no_confidential_inventory_date" class="control-label">@lang('ua.no_confidential_inventory_date'):</label>
                </div>

                <div class="col-sm-3">
                    <input id="no_confidential_inventory_date" class="form-control" name="no_confidential_inventory_date" type="date">
                </div>
            </div>
        </div>

        <div class="tab-pane" id="select-disk-no-conf">
            <div class="row tabbable add-space-top">
                <div class="col-sm-3">
                    <label for="no_confidential_disk" class="control-label">@lang('ua.no_confidential_disk'):</label>
                </div>

                <div class="col-sm-3">
                    <input id="no_confidential_disk" class="form-control" name="no_confidential_disk">
                </div>

                <div class="col-sm-3">
                    <label for="no_confidential_disk_date" class="control-label">@lang('ua.no_confidential_disk_date'):</label>
                </div>

                <div class="col-sm-3">
                    <input id="no_confidential_disk_date" class="form-control" name="no_confidential_disk_date" type="date">
                </div>
            </div>
        </div>
    </div>

    <div class="row add-space-top">
        <div class="col-sm-3">
            <label for="header" class="control-label">@lang('ua.header'):</label>
        </div>

        <div class="col-sm-9">
            <textarea id="header" class="form-control" name="header"></textarea>
            {{--<input id="header" class="form-control" name="header" type="text">--}}
        </div>
    </div>

    <div class="row add-space-top">
        <div class="col-sm-3">
            <label for="author" class="control-label">@lang('ua.author'):</label>
        </div>

        <div class="col-sm-9">
            <input id="author" class="form-control" name="author">
        </div>
    </div>

    <div class="row add-space-top">
        <div class="col-sm-3">
            <label for="correspondent" class="control-label">@lang('ua.correspondent'):</label>
        </div>

        <div class="col-sm-9">
            <input id="correspondent" class="form-control" name="correspondent">
        </div>
    </div>

    <div class="row add-space-top">
        <div class="col-sm-3">
            <label for="key_words" class="control-label">@lang('ua.key_words'):</label>
        </div>

        <div class="col-sm-9">
            <textarea id="key_words" class="form-control" name="key_words"></textarea>
            {{--<input id="key_words" class="form-control" name="key_words">--}}
        </div>
    </div>

    <div class="row add-space-top">
        <div class="col-sm-3">
            <label for="number_of_copies" class="control-label">@lang('ua.number_of_copies'):</label>
        </div>

        <div class="col-sm-3">
            <input id="number_of_copies" class="form-control" name="number_of_copies" type="number">
        </div>

        <div class="col-sm-3">
            <label for="number_of_pages" class="control-label">@lang('ua.number_of_pages'):</label>
        </div>

        <div class="col-sm-3">
            <input id="number_of_pages" class="form-control" name="number_of_pages" type="number">
        </div>
    </div>

    <div class="row add-space-top">
        <div class="col-sm-3">
            <label for="number_of_appendix" class="control-label">@lang('ua.number_of_appendix'):</label>
        </div>

        <div class="col-sm-3">
            <input id="number_of_appendix" class="form-control" name="number_of_appendix" type="number">
        </div>

        <div class="col-sm-3">
            <label for="number_of_pages_appendix" class="control-label">@lang('ua.number_of_pages_appendix'):</label>
        </div>

        <div class="col-sm-3">
            <input id="number_of_pages_appendix" class="form-control" name="number_of_pages_appendix" type="number">
        </div>
    </div>

    <div class="row add-space-top">
        <div class="col-sm-3">
            <label for="case_number" class="control-label">@lang('ua.case_number'):</label>
        </div>

        <div class="col-sm-3">
            <input id="case_number" class="form-control" name="case_number" type="number">
        </div>

        <div class="col-sm-3">
            <label for="page_in_case" class="control-label">@lang('ua.page_in_case'):</label>
        </div>

        <div class="col-sm-3">
            <input id="page_in_case" class="form-control" name="page_in_case" type="number">
        </div>
    </div>

    <div class="row add-space-top">
        <div class="col-sm-2">
            <label for="doc_body" class="control-label">@lang('ua.doc_body'):</label>
        </div>

        <div class="col-sm-4">
            <input id="doc_body" class="form-control" name="doc_body" type="file">
        </div>

        <div class="col-sm-2">
            <label for="appendices" class="control-label">@lang('ua.appendices'):</label>
        </div>

        <div class="col-sm-4">
            <input id="appendices" class="form-control" name="appendices[]" type="file" multiple>
            {{--<p>--}}
            {{--<input id="appendices" class="form-control" name="appendices[]" type="file">--}}
            {{--<input type="button" value="+">--}}
            {{--<input type="button" value="-">--}}
            {{--</p>--}}
        </div>
        {{--<script type="text/javascript">--}}
        {{--$(function () {--}}
        {{--$(document).on("click", "input[type='button'][value != '+']", remove_field);--}}
        {{--$(document).on("click", "input[type='button'][value != '-']", add_field);--}}
        {{--});--}}
        {{----}}
        {{--function add_field() {--}}
        {{--$("p:last").clone().insertAfter("p:last");--}}
        {{--}--}}

        {{--function remove_field() {--}}
        {{--$("p:last").remove();--}}
        {{--}--}}
        {{--</script>--}}
    </div>
    <div class="row add-space-top">
        <div class="col-sm-3 col-sm-offset-6">
            <button type="submit" class="btn btn-primary">
                @lang('ua.Create')
            </button>
        </div>
    </div>
</form>
