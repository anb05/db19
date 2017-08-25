<div class="form-group{{ $errors->has('case_number') ? ' has-error' : '' }}">
    <label for="case_number-{{ $types[$count]->name }}" class="col-md-2 control-label">CASE NUMBER:</label>
    <div class="col-md-10">
        <input name="case_number" id="case_number-{{ $types[$count]->name }}" type="text" class="form-control" placeholder="CASE NUMBER">

        @if ($errors->has('case_number'))
            <span class="help-block">
                <strong>{{ $errors->first('case_number') }}</strong>
            </span>
        @endif

    </div>
</div>
