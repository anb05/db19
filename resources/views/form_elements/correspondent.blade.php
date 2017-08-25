<div class="form-group{{ $errors->has('correspondent') ? ' has-error' : '' }}">
    <label for="correspondent-{{ $types[$count]->name }}" class="col-md-2 control-label">CORRESPONDENT:</label>
    <div class="col-md-10">
        <textarea name="correspondent" id="correspondent-{{ $types[$count]->name }}" class="form-control" placeholder="CORRESPONDENT"></textarea>

        @if ($errors->has('correspondent'))
            <span class="help-block">
                <strong>{{ $errors->first('correspondent') }}</strong>
            </span>
        @endif

    </div>
</div>
