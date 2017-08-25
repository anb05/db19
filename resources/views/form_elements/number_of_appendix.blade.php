<div class="form-group{{ $errors->has('number_of_appendix') ? ' has-error' : '' }}">
    <label for="number_of_appendix-{{ $types[$count]->name }}" class="col-md-2 control-label">NUMBER OF APPENDIX:</label>
    <div class="col-md-10">
        <input name="number_of_appendix" id="number_of_appendix-{{ $types[$count]->name }}" type="number" class="form-control" placeholder="NUMBER OF APPENDIX">

        @if ($errors->has('number_of_appendix'))
        <span class="help-block">
                <strong>{{ $errors->first('number_of_appendix') }}</strong>
            </span>
        @endif

    </div>
</div>
