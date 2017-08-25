<div class="form-group{{ $errors->has('number_of_pages_appendix') ? ' has-error' : '' }}">
    <label for="number_of_pages_appendix-{{ $types[$count]->name }}" class="col-md-2 control-label">NUMBER OF PAGES APPENDIX:</label>
    <div class="col-md-10">
        <input name="number_of_pages_appendix" id="number_of_pages_appendix-{{ $types[$count]->name }}" type="number" class="form-control" placeholder="NUMBER OF PAGES APPENDIX">

        @if ($errors->has('number_of_pages_appendix'))
            <span class="help-block">
                <strong>{{ $errors->first('number_of_pages_appendix') }}</strong>
            </span>
        @endif

    </div>
</div>
