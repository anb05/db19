<?php $prefix = Auth::user()->role_name . "_"; ?>

<div class="row" id="show-drafts">

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {!! session('error') !!}
        </div>
    @elseif(session('message'))
        <div class="alert alert-success text-center">
            {!! session('message') !!}
        </div>
    @endif

    <table class="table table-hover">
        <thead>
        <tr>
            @for($count = 0; $count < 5; $count++)
                <th class="col-md-1 text-center">
                    <a href="{{ route($prefix . 'show_drafts',
                     ['document_type' => $type ,'activeColumn' => $orders[$count]]) }}">
                        {{ $allColumnName[$orders[$count]] }}
                    </a>

                    @if($columnSort == $orders[$count])
                        @if($directionSort === 'desc')
                            <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                        @else
                            <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                        @endif
                    @else
                        <span class="glyphicon glyphicon-sort" aria-hidden="true"></span>
                    @endif

                </th>
            @endfor

                <th class="col-md-1 text-center">{{ trans('ua.Prepared') }}</th>

                <th class="col-md-1 text-center">{{ trans('ua.Delete') }}</th>
        </tr>
        </thead>
        @foreach($view_drafts as $draft)
            <tr class="text-center">
                @for($count = 0; $count < 5; $count++)
                    <?php $index = $orders[$count]; ?>
                    <td>
                        <a href="{{ route($prefix . 'edit_draft', ['draft' => $draft->id]) }}">
                            {!! str_limit(strip_tags($draft->$index), 100) !!}
                        </a>
                    </td>
                @endfor
                <td>
                    <form action="{{ route($prefix . 'edit_draft', ['draft' => $draft->id]) }}"
                          method="post"
                          class="form-horizontal">
                        {{ csrf_field() }}

                        <input type="hidden" name="_method" value="prepared">
                        <button class="btn btn-success" type="submit">@lang('ua.Prepared')</button>
                    </form>
                </td>

                <td>
                    <form action="{{ route($prefix . 'edit_draft', ['draft' => $draft->id]) }}"
                          method="post"
                          class="form-horizontal">
                        {{ csrf_field() }}

                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-danger" type="submit">@lang('ua.delete')</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

        <nav aria-label="Page navigation" class="navbar navbar-fixed-bottom">
            <div class="container">
                {{ $view_drafts->appends(['glyphSort' => $columnSort])->links() }}
            </div>
        </nav>
</div>