<div class="form-group{{ $errors->has('number_of_copies') ? ' has-error' : '' }}">
    <label for="number_of_copies-{{ $types[$count]->name }}" class="col-md-2 control-label">NUMBER OF COPIES:</label>
    <div class="col-md-10">
        <input name="number_of_copies" id="number_of_copies-{{ $types[$count]->name }}" type="number" class="form-control" placeholder="NUMBER OF COPIES">

        @if ($errors->has('number_of_copies'))
            <span class="help-block">
                <strong>{{ $errors->first('number_of_copies') }}</strong>
            </span>
        @endif

    </div>
</div>
