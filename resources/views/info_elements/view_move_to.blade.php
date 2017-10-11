<div class="row">
    <div class="col-sm-10 col-sm-offset-1 col-md-offset-1 col-md-5">
        <form action="{{ route('prepared_to', ['prepared' => $prepared->id]) }}"
              method="post"
              class="form-horizontal">

            {{ csrf_field() }}

            <input type="hidden" name="direct_to" value="to_draft">
            <button class="btn btn-warning btn-lg btn-block"
                    type="submit">
                @lang('ua.BackToDrafts')
            </button>
        </form>
    </div>

    <div class="col-sm-10 col-sm-offset-1 col-md-offset-0 col-md-5">
        <form action="{{ route('prepared_to', ['prepared' => $prepared->id]) }}"
              method="post"
              class="form-horizontal">

            {{ csrf_field() }}

            <input type="hidden" name="direct_to" value="to_checked">
            <button class="btn btn-primary btn-lg btn-block" type="submit">@lang('ua.CheckedToWork')</button>
        </form>
    </div>
</div>