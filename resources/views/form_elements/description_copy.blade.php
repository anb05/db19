<div class="form-group{{ $errors->has('description_copy') ? ' has-error' : '' }}">
    <label for="description_copy-{{ $types[$count]->name }}" class="col-md-2 control-label">DESCRIPTION COPY:</label>
    <div class="col-md-10">
        <textarea name="description_copy" id="description_copy-{{ $types[$count]->name }}" class="form-control" placeholder="DESCRIPTION COPY"></textarea>

        @if ($errors->has('description_copy'))
            <span class="help-block">
                <strong>{{ $errors->first('description_copy') }}</strong>
            </span>
        @endif

    </div>
</div>
