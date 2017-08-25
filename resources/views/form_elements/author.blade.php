<div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
    <label for="author-{{ $types[$count]->name }}" class="col-md-2 control-label">AUTHOR:</label>
    <div class="col-md-10">
        <input name="author" id="author-{{ $types[$count]->name }}" type="text" class="form-control" placeholder="AUTHOR">

        @if ($errors->has('author'))
            <span class="help-block">
                <strong>{{ $errors->first('author') }}</strong>
            </span>
        @endif

    </div>
</div>
