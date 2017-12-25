<div class="form-group{{ $errors->has($column) ? ' has-error' : '' }}">

    <label for="{{ $column }}" class="control-label">
        {{ $allColumnName->$column }}:
    </label>

        <input name="{{ $column }}"
               id="{{ $column }}"
               type="number"
               class="form-control"
               placeholder="{{ $allColumnName->$column }}"
               value="{!! (!empty($prepareData)) ? $prepareData[$column] : old($column) !!}">

        @if ($errors->has($column))
            <span class="help-block">
                <strong>{{ $errors->first($column) }}</strong>
            </span>
        @endif
</div>
