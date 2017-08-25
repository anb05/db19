<div class="form-group{{ $errors->has('return_date') ? ' has-error' : '' }}">
    <label for="return_date-{{ $types[$count]->name }}" class="col-md-2 control-label">RETURN DATE:</label>
    <div class="col-md-10">
        <input name="return_date" id="return_date-{{ $types[$count]->name }}" type="date" class="form-control" placeholder="RETURN DATE">

        @if ($errors->has('return_date'))
            <span class="help-block">
                <strong>{{ $errors->first('return_date') }}</strong>
            </span>
        @endif

    </div>
</div>
