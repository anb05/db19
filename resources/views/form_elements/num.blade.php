<div class="form-group{{ $errors->has('num') ? ' has-error' : '' }}">
    <label for="num-{{ $types[$count]->name }}" class="col-md-2 control-label">NUM:</label>
    <div class="col-md-10">
        <input name="num" id="num-{{ $types[$count]->name }}" type="text" class="form-control" placeholder="NUM">

        @if ($errors->has('num'))
            <span class="help-block">
                <strong>{{ $errors->first('num') }}</strong>
            </span>
        @endif

    </div>
</div>
