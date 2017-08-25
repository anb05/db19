<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
    <label for="date-{{ $types[$count]->name }}" class="col-md-2 control-label">DATE:</label>
    <div class="col-md-10">
        <input name="date" id="date-{{ $types[$count]->name }}" type="date" class="form-control" placeholder="DATE">

        @if ($errors->has('date'))
            <span class="help-block">
                <strong>{{ $errors->first('date') }}</strong>
            </span>
        @endif

    </div>
</div>
