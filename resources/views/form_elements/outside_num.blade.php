<div class="form-group{{ $errors->has('outside_num') ? ' has-error' : '' }}">
    <label for="outside_num-{{ $types[$count]->name }}" class="col-md-2 control-label">OUTSIDE NUM:</label>
    <div class="col-md-10">
        <input name="outside_num" id="outside_num-{{ $types[$count]->name }}" type="text" class="form-control" placeholder="OUTSIDE NUM">

        @if ($errors->has('outside_num'))
            <span class="help-block">
                <strong>{{ $errors->first('outside_num') }}</strong>
            </span>
        @endif

    </div>
</div>
