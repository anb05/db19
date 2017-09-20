<div class="row">
    <div class="col-sm-10 col-sm-offset-1 col-md-offset-1 col-md-5">
        <div class="table-responsive">
            {{--{!! dump($controls) !!}--}}
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
                            {!! $control->user->name !!}
                            responsible Executor
                        </td>

                        <td>
                            {!! $control->executed_time !!}
                        </td>
                        <td class="text-center">
                            <form action="#"
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

            {{--<button type="button" class="btn btn-warning btn-lg btn-block">@lang('ua.AddControl')</button>--}}





            {{--<!-- Button trigger modal -->--}}
            <button type="button" class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#addControl">
                @lang('ua.AddControl')
            </button>

            {{--<!-- Modal -->--}}
            <div class="modal fade" id="addControl" tabindex="-1" role="dialog" aria-labelledby="addControl">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <form class="form"
                              method="post"
                              action="{{ route('manipulate_control') }}">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Форма створення контролю виконання документа</h4>
                            </div>
                            <div class="modal-body">

                                {{ csrf_field() }}
                                <input type="hidden" name="document_id" value="{{ $draftId }}">

                                <div class="form-group{{ $errors->has('control_number') ? ' has-error' : '' }}">
                                    <label for="control_number">
                                        <h1>Введіть номер контролю</h1>
                                    </label>

                                    <input type="text"
                                           id="control_number"
                                           name="control_number"
                                           placeholder="Номер контролю"
                                           value="{!! old('control_number') !!}">
                                </div>

                                <div class="form-group{{ $errors->has('check_time') ? ' has-error' : ''}}">
                                    <label for="check_time">
                                        <h1>Введіть контрольний час</h1>
                                    </label>

                                    <input type="date"
                                           id="check_time"
                                           name="check_time"
                                           placeholder="Контрольна дата"
                                           value="{!! old('check_time') !!}">
                                </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    @lang('ua.Cancel')
                                </button>

                                <button type="submit" class="btn btn-primary">
                                    @lang('ua.AddControl')
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>












        </div>

    </div>
    <div class="col-sm-10 col-sm-offset-1 col-md-offset-0 col-md-5">
        <div class="table-responsive">
{{--            {!! dump($resolutions) !!}--}}
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
                <tr>
                    <td>
                        Commander
                    </td>

                    <td>
                        {{ time() }}
                    </td>

                    <td>
                        Resolution text
                    </td>

                    <td class="text-center">
                        <form action=""
                              method="post"
                              class="form-horizontal">
                            {{ csrf_field() }}

                            <input type="hidden" name="_method" value="delete">
                            <button class="btn btn-danger" type="submit">@lang('ua.delete')</button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-warning btn-lg btn-block">@lang('ua.AddResolution')</button>
        </div>
    </div>
</div>
