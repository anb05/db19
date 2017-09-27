@if(Auth::user()->role_name === 'moderator')
    <?php $prefix = 'moderator_'; ?>
@else
    <?php $prefix = ''; ?>
@endif

<div class="row">
    <div class="col-sm-10 col-sm-offset-1 col-md-offset-1 col-md-5">
        <div class="table-responsive">
            <table class="table table-hover">
                <caption class="text-center"><h2>Контроль</h2></caption>
                <thead>
                <tr>
                    <th class="text-center">
                        @lang('ua.numberOfControl')
                    </th>

                    <th class="text-center">
                        @lang('ua.dateOfControl')
                    </th>

                    <th class="text-center">
                        @lang('ua.responsibleExecutor')
                    </th>

                    <th class="text-center">
                        @lang('ua.dateExecute')
                    </th>

                    <th class="text-center">
                        @lang('ua.Delete')
                    </th>
                </tr>
                </thead>

                <tbody>
                @foreach($controls as $control)
                    <tr>
                        <td>
                            {!! $control->control_number !!}
                        </td>

                        <td>
                            {!! $control->check_time !!}
                        </td>

                        <td>
                            {!! $users->where('id', $control->responsible_executor)->first()->full_name !!}
                        </td>

                        <td>
                            {!! $control->executed_time !!}
                        </td>
                        <td class="text-center">
                            <form action="{{ route($prefix . 'manipulate_control', ['control' => $control->id]) }}"
                                  method="post"
                                  class="form-horizontal">
                                {{ csrf_field() }}

                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-danger" type="submit">@lang('ua.delete')</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{--<!-- Button trigger modal -->--}}
            <button type="button" class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#addControl">
                @lang('ua.AddControl')
            </button>

            {{--<!-- Modal -->--}}
            <div class="modal fade" id="addControl" tabindex="-1" role="dialog" aria-labelledby="addControlLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="addControlLabel">Форма створення контролю виконання документа</h4>
                        </div>
                        <div class="modal-body">

                            <form class="form"
                                  id="add_control"
                                  method="post"
                                  action="{{ route($prefix . 'manipulate_control') }}">

                                {{ csrf_field() }}
                                <input type="hidden" name="document_id" value="{{ $draftId }}">

                                <div class="form-group{{ $errors->has('control_number') ? ' has-error' : '' }}">
                                    <label for="control_number" class="control-label">
                                        Введіть номер контролю
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           id="control_number"
                                           name="control_number"
                                           placeholder="Номер контролю"
                                           value="{!! old('control_number') !!}">
                                </div>

                                <div class="form-group{{ $errors->has('check_time') ? ' has-error' : ''}}">
                                    <label for="check_time" class="control-label">
                                        Введіть контрольний час
                                    </label>

                                    <input type="date"
                                           class="form-control"
                                           id="check_time"
                                           name="check_time"
                                           placeholder="Контрольна дата"
                                           value="{!! old('check_time') !!}">
                                </div>

                                <div class="form-group{{ $errors->has('responsible_executor') ? ' has-error' : '' }}">
                                    <label for="responsible_executor" class="control-label">
                                        Відповідальний виконавець
                                    </label>

                                    <input list="users"
                                           value="{{ old('responsible_executor') }}"
                                           class="form-control"
                                           id="responsible_executor"
                                           name="responsible_executor"
                                           placeholder="Введіть відповідального виконавця">
                                    <datalist id="users">
                                        {{--<select>--}}
                                            @foreach(($users->groupBy('group_name')) as $group => $items)
                                            <option>{{ $group }}</option>
                                                    @foreach($items as $user)
                                                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                                    @endforeach
                                            @endforeach
                                        {{--</select>--}}
                                    </datalist>
                                </div>

                                <div class="form-group{{ $errors->has('executed_time') ? ' has-error' : ''}}">
                                    <label for="executed_time" class="control-label">
                                        Введіть дату відправки контрольного документа
                                    </label>

                                    <input type="date"
                                           class="form-control"
                                           id="executed_time"
                                           name="executed_time"
                                           placeholder="Якщо документ відпрацьовано введіт відповідну дату"
                                           value="{!! old('check_time') !!}">
                                </div>

                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                @lang('ua.Cancel')
                            </button>

                            <button type="submit" class="btn btn-primary" form="add_control">
                                @lang('ua.AddControl')
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-10 col-sm-offset-1 col-md-offset-0 col-md-5">
        <div class="table-responsive">

            <table class="table table-hover">
                <caption class="text-center"><h2>Резолюції</h2></caption>
                <thead>
                <tr>
                    <th class="text-center">
                        @lang('ua.WhoImpose')
                    </th>

                    <th class="text-center">
                        @lang('ua.date')
                    </th>

                    <th class="text-center">
                        @lang('ua.TextResolution')
                    </th>

                    <th class="text-center">
                        @lang('ua.Delete')
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($resolutions as $resolution)
                    <tr>
                        <td>
                            {!! $users->where('id', $resolution->human_id)->first()->full_name !!}
                        </td>

                        <td>
                            {!! $resolution->date !!}
                        </td>

                        <td>
                            {!! str_limit($resolution->resolution, 100) !!}
                        </td>

                        <td class="text-center">
                            <form action="{{ route($prefix . 'manipulate_resolution', ['resolution' => $resolution->id]) }}"
                                  method="post"
                                  class="form-horizontal">
                                {{ csrf_field() }}

                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-danger" type="submit">@lang('ua.delete')</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{--<!-- Button trigger modal -->--}}
            <button type="button" class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#addResolution">
                @lang('ua.AddResolution')
            </button>

            {{--<!-- Modal -->--}}
            <div class="modal fade" id="addResolution" tabindex="-1" role="dialog" aria-labelledby="addResolutionLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="addResolutionLabel">Форма створення резолюції</h4>
                        </div>
                        <div class="modal-body">

                            <form class="form"
                                  id="add_resolution"
                                  method="post"
                                  action="{{ route($prefix . 'manipulate_resolution') }}">

                                {{ csrf_field() }}
                                <input type="hidden" name="document_id" value="{{ $draftId }}">

                                <div class="form-group{{ $errors->has('human_id') ? ' has-error' : '' }}">
                                    <label for="human_id" class="control-label">
                                        Особа, яка наклала резолюцію
                                    </label>

                                    <input list="human"
                                           value="{{ old('human_id') }}"
                                           class="form-control"
                                           id="human_id"
                                           name="human_id"
                                           placeholder="Почніть вводити прізвище особи">
                                    <datalist id="human">
                                        {{--<select>--}}
                                        @foreach(($users->groupBy('group_name')) as $group => $items)
                                            <option>{{ $group }}</option>
                                            @foreach($items as $user)
                                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                            @endforeach
                                        @endforeach
                                        {{--</select>--}}
                                    </datalist>
                                </div>

                                <div class="form-group{{ $errors->has('resolution') ? ' has-error' : '' }}">
                                    <label for="resolution" class="control-label">
                                        Введіть текст резолюції
                                    </label>

                                    <textarea class="form-control"
                                           id="resolution"
                                           name="resolution"
                                           placeholder="Текст резолюції">{!! old('resolution') !!}</textarea>
                                </div>

                                <div class="form-group{{ $errors->has('date') ? ' has-error' : ''}}">
                                    <label for="date" class="control-label">
                                        Введіть дату накладання резолюції
                                    </label>

                                    <input type="date"
                                           class="form-control"
                                           id="date"
                                           name="date"
                                           placeholder="Дата накладання резолюції"
                                           value="{!! old('date') !!}">
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                @lang('ua.Cancel')
                            </button>

                            <button type="submit" class="btn btn-primary" form="add_resolution">
                                @lang('ua.AddResolution')
                            </button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
