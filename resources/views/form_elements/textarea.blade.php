<div class="form-group{{ $errors->has($column) ? ' has-error' : '' }}">

    <label for="{{ $column }}" class="control-label">
        {{ $allColumnName->$column }}:
    </label>

    <textarea name="{{ $column }}"
              id="{{ $column }}"
              class="form-control"
              placeholder="{{ $allColumnName->$column }}">{{ old($column) }}</textarea>

    @if ($errors->has($column))
        <span class="help-block">
                <strong>{{ $errors->first($column) }}</strong>
            </span>
    @endif
</div>
