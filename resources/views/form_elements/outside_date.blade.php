<div class="form-group{{ $errors->has('outside_date') ? ' has-error' : '' }}">
    <label for="outside_date-{{ $types[$count]->name }}" class="col-md-2 control-label">OUTSIDE DATE:</label>
    <div class="col-md-10">
        <input name="outside_date" id="outside_date-{{ $types[$count]->name }}" type="date" class="form-control" placeholder="OUTSIDE dATE">

        @if ($errors->has('outside_date'))
            <span class="help-block">
                <strong>{{ $errors->first('outside_date') }}</strong>
            </span>
        @endif

    </div>
</div>
