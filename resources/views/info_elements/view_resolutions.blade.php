<div class="row">
    {{--<div class="col-sm-10 col-sm-offset-1 col-md-offset-0 col-md-5">--}}
    <div class="col-sm-10 col-sm-offset-1 col-md-offset-1 col-md-10">

        <div class="panel panel-primary }}">
            <div class="panel-heading">
                <h3 class="text-center">Резолюції</h3>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr class="text-center">
                            <th class="text-center">
                                @lang('ua.WhoImpose')
                            </th>

                            <th class="text-center">
                                @lang('ua.date')
                            </th>

                            <th class="text-center">
                                @lang('ua.TextResolution')
                            </th>
                        </tr>

                        @if(!empty($resolutions))
                            @foreach($resolutions as $resolution)
                                <tr class="text-center">
                                    <td>
                                        {!! $resolution->human_id !!}
                                    </td>

                                    <td>
                                        {!! $resolution->date->format('d.m.Y') !!}
                                    </td>

                                    <td>
                                        {!! $resolution->resolution !!}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
