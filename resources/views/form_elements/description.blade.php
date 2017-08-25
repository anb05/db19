<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description-{{ $types[$count]->name }}" class="col-md-2 control-label">DESCRIPTION:</label>
    <div class="col-md-10">
        <textarea name="description" id="description-{{ $types[$count]->name }}" class="form-control" placeholder="DESCRIPTION"></textarea>

        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif

    </div>
</div>
