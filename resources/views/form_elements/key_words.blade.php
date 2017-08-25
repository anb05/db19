<div class="form-group{{ $errors->has('key_words') ? ' has-error' : '' }}">
    <label for="key_words-{{ $types[$count]->name }}" class="col-md-2 control-label">KEY WORDS:</label>
    <div class="col-md-10">
        <textarea name="key_words" id="key_words-{{ $types[$count]->name }}" class="form-control" placeholder="KEY WORDS"></textarea>

        @if ($errors->has('key_words'))
            <span class="help-block">
                <strong>{{ $errors->first('key_words') }}</strong>
            </span>
        @endif

    </div>
</div>
