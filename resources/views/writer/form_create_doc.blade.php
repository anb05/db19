{{-- Tab panes from aside_menu --}}
{{--{{ dump($types) }}--}}
{{--{{ dump($orders) }}--}}
<div class="tab-content">
    @for($count = 0; $count < count($types); $count++)
        <div role="tabpanel" class="tab-pane {{ ($count == \Config::get('db19.startBook')) ? 'active' : '' }}" id="{{ $types[$count]->name }}">
            <form class="form-horizontal" method="post" action="{{ route('handle_form') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="page-header text-center">
                    <h1>{!! str_replace('\n', '<br>', $types[$count]->native_name) !!}</h1>
                </div>

                @foreach($orders[$types[$count]->name] as $view)
                        @includeIf('form_elements.' . $view)
                @endforeach

                {{-- Код формирование полей формы --}}

{{--                @include('form_elements.num')--}}

                {{--@include('form_elements.date')--}}

                {{--@include('form_elements.author')--}}

                {{--@include('form_elements.header')--}}

                {{--@include('form_elements.key_words')--}}

                {{--@include('form_elements.description')--}}

{{--                @include('form_elements.number_of_copies')--}}

{{--                @include('form_elements.number_of_pages')--}}

{{--                @include('form_elements.description_copy')--}}

{{--                @include('form_elements.number_of_appendix')--}}

{{--                @include('form_elements.number_of_pages_appendix')--}}

{{--                @include('form_elements.case_number')--}}

{{--                @include('form_elements.page_in_case')--}}

{{--                @include('form_elements.outside_num')--}}

{{--                @include('form_elements.outside_date')--}}

{{--                @include('form_elements.correspondent')--}}

{{--                @include('form_elements.return_date')--}}

                {{-- Код формирование полей формы --}}

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
                    </div>
                </div>

                <div class="row add-space-top">
                    <div class="col-sm-3 col-sm-offset-6">
                        <button type="submit" class="btn btn-primary">
                            @lang('ua.Create')
                        </button>
                    </div>
                </div>
            </form>

        </div>
    @endfor
        <script>
           $('.textarea').wysihtml5();
        </script>
</div>
