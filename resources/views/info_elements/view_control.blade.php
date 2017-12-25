<div class="row">
    {{--<div class="col-sm-10 col-sm-offset-1 col-md-offset-1 col-md-5">--}}
    <div class="col-sm-10 col-sm-offset-1 col-md-offset-1 col-md-10">
        <div class="panel panel-{{ $panelClass }}">
            <div class="panel-heading">
                <h3 class="text-center">Контроль</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th class="text-center">
                                @lang('ua.numberOfControl')
                            </th>

                            <th class="text-center">
                                @lang('ua.dateOfControl')
                            </th>

                            <th class="text-center">
                                @lang('ua.Period')
                            </th>

                            <th class="text-center">
                                @lang('ua.dateExecute')
                            </th>

                            <th class="text-center">
                                @lang('ua.responsibleExecutor')
                            </th>
                        </tr>

                        <?php $count = 0; ?>
                        @foreach($controls as $control)
                            <tr class="text-center {{ $delta[$count] }}">
                                <?php $count++; ?>
                                <td>
                                    {!! $control->control_number !!}
                                </td>

                                <td>
                                    {!! $control->check_time->format('d.m.Y') !!}
                                </td>

                                <td>
                                    @if($control->executed_time)
                                        {!! 'Виконано' !!}
                                    @else
                                        {!! $control->check_time->diffInDays(\Carbon\Carbon::now()) !!}
                                    @endif
                                </td>

                                <td>
                                    @if($control->executed_time)
                                        {!! $control->executed_time->format('d.m.Y') !!}
                                    @endif
                                </td>

                                <td class="text-left">
                                    {!! $control->responsible_executor !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

