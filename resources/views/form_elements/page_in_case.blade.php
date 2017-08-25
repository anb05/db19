<div class="form-group{{ $errors->has('page_in_case') ? ' has-error' : '' }}">
    <label for="page_in_case-{{ $types[$count]->name }}" class="col-md-2 control-label">PAGE IN CASE:</label>
    <div class="col-md-10">
        <input name="page_in_case" id="page_in_case-{{ $types[$count]->name }}" type="number" class="form-control" placeholder="PAGE IN CASE">

        @if ($errors->has('page_in_case'))
            <span class="help-block">
                <strong>{{ $errors->first('page_in_case') }}</strong>
            </span>
        @endif

    </div>
</div>
