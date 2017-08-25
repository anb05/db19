<div class="form-group{{ $errors->has('number_of_pages') ? ' has-error' : '' }}">
    <label for="number_of_pages-{{ $types[$count]->name }}" class="col-md-2 control-label">NUMBER OF PAGES:</label>
    <div class="col-md-10">
        <input name="number_of_pages" id="number_of_pages-{{ $types[$count]->name }}" type="number" class="form-control" placeholder="NUMBER OF PAGES">

        @if ($errors->has('number_of_pages'))
            <span class="help-block">
                <strong>{{ $errors->first('number_of_pages') }}</strong>
            </span>
        @endif

    </div>
</div>
