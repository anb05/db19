<div class="tab-content">

    <div class="page-header text-center">
        <h1>{!! str_replace('\n', '<br>', $allColumnName->native_name) !!}</h1>
    </div>

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {!! session('error') !!}
        </div>
    @elseif(session('message'))
        <div class="alert alert-success text-center">
            {!! session('message') !!}
        </div>
    @endif

    <form class="form"
          method="post"
          @if(Auth::user()->role_name === 'moderator')
          action="{{ route('moderator_handle_form') }}"
          @else
          action="{{ route('handle_form') }}"
          @endif
          enctype="multipart/form-data">

        {{ csrf_field() }}
        <input type="hidden" name="type_name" value="{{ $allColumnName->name }}">
        @foreach($orders as $column)

            @if( ($column == 'author') || ($column == 'case_number') || ($column == 'num') || ($column == 'outside_num'))
                @includeIf('form_elements.text')
            @elseif(($column == 'date') || ($column == 'outside_date') || ($column == 'return_date'))
                @includeIf('form_elements.date')
            @elseif(($column == 'number_of_appendix') || ($column == 'number_of_copies') || ($column == 'number_of_pages') || ($column == 'number_of_pages_appendix') || ($column == 'page_in case'))
                @includeIf('form_elements.number')
            @elseif(($column == 'correspondent') || ($column == 'description') || ($column == 'description_copy') || ($column == 'header') || ($column == 'key_words'))
                @includeIf('form_elements.textarea')
            @endif

        @endforeach

        <div class="row add-space-top">
            <div class="col-sm-2">
                <label for="doc_body" class="control-label">@lang('ua.doc_body'):</label>
            </div>

            <div class="col-sm-4">
                <input id="doc_body" class="form-control" name="doc_body" type="file" value="{{ old('doc_body') }}">
            </div>

            <div class="col-sm-2">
                <label for="appendices" class="control-label">@lang('ua.appendices'):</label>
            </div>

            <div class="col-sm-4">
                <input id="appendices" class="form-control" name="appendices[]" type="file" multiple value="{{ old('appendices[]') }}">
            </div>
        </div>

        <div class="row add-space-top">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    @lang('ua.CreateDraft')
                </button>
            </div>
        </div>

    </form>
</div>
