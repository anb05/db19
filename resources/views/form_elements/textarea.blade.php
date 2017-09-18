<div class="form-group{{ $errors->has($column) ? ' has-error' : '' }}">

    <label for="{{ $column }}" class="control-label">
        {{ $allColumnName->$column }}:
    </label>

    <textarea name="{{ $column }}"
              id="{{ $column }}"
              {{--class="form-control"--}}
              placeholder="{{ $allColumnName->$column }}">
        @if(!empty($prepareData))
            {!! $prepareData[$column] !!}
        @else
            {{ old($column) }}
        @endif
    </textarea>

    @if ($errors->has($column))
        <span class="help-block">
                <strong>{{ $errors->first($column) }}</strong>
            </span>
    @endif
    <script>
        CKEDITOR.replace( "{{ $column }}" );
    </script>
</div>
