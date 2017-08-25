<div class="form-group{{ $errors->has('header') ? ' has-error' : '' }}">
    <label for="header-{{ $types[$count]->name }}" class="col-md-2 control-label">HEADER:</label>
    <div class="col-md-10">
        <textarea name="header" id="header-{{ $types[$count]->name }}" class="form-control" placeholder="HEADER"></textarea>

        @if ($errors->has('header'))
            <span class="help-block">
                <strong>{{ $errors->first('header') }}</strong>
            </span>
        @endif

    </div>
</div>
