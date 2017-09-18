<div class="row add-space-top">
    <h2 class="text-center">Редагування відомостей</h2>
    <div class="col-sm-10 col-sm-offset-1 col-md-offset-1 col-md-10">
        <form class="form"
              method="post"
              action="{{ route('edit_draft', ['draft' => $prepareData['id']]) }}"
              enctype="multipart/form-data">

            {{ csrf_field() }}
            <input type="hidden" name="type_name" value="{{ $prepareData['type_name'] }}">

            <input type="hidden" name="id" value="{{ $prepareData['id'] }}">

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

            <button type="submit" class="btn btn-primary btn-lg btn-block">
                @lang('ua.ReloadDraft')
            </button>
        </form>
    </div>
</div>