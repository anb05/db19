<?php $prefix = Auth::user()->role_name . "_"; ?>

<div class="row" id="show-prepareds">

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
                    <a href="{{ route($prefix . 'show_prepareds',
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

                {{--<th class="col-md-1 text-center">{{ trans('ua.BackToDrafts') }}</th>--}}

                {{--<th class="col-md-1 text-center">{{ trans('ua.CheckedToWork') }}</th>--}}
        </tr>
        </thead>
        @foreach($view_prepareds as $prepared)
            <tr class="text-center">
                @for($count = 0; $count < 5; $count++)
                    <?php $index = $orders[$count]; ?>
                    <td>
                        <a href="{{ route('detail_survey_info', ['$prepared' => $prepared->id]) }}">
                            {!! str_limit(strip_tags($prepared->$index), 100) !!}
                        </a>
                    </td>
                @endfor
                {{--<td>--}}
                    {{--<form action="{{ route('prepared_to', ['prepared' => $prepared->id]) }}"--}}
                          {{--method="post"--}}
                          {{--class="form-horizontal">--}}

                        {{--{{ csrf_field() }}--}}

                        {{--<input type="hidden" name="direct_to" value="to_draft">--}}
                        {{--<button class="btn btn-warning" type="submit">@lang('ua.BackToDrafts')</button>--}}
                    {{--</form>--}}
                {{--</td>--}}

                {{--<td>--}}
                    {{--<form action="{{ route('prepared_to', ['prepared' => $prepared->id]) }}"--}}
                          {{--method="post"--}}
                          {{--class="form-horizontal">--}}

                        {{--{{ csrf_field() }}--}}

                        {{--<input type="hidden" name="direct_to" value="to_checked">--}}
                        {{--<button class="btn btn-primary" type="submit">@lang('ua.CheckedToWork')</button>--}}
                    {{--</form>--}}
                {{--</td>--}}
            </tr>
        @endforeach
    </table>

        <nav aria-label="Page navigation" class="navbar navbar-fixed-bottom">
            <div class="container">
                {{ $view_prepareds->appends(['glyphSort' => $columnSort])->links() }}
            </div>
        </nav>
</div>