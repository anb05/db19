<div class="row">
    <div class="col-sm-10 col-sm-offset-1 col-md-offset-1 col-md-5">
        <div class="table-responsive">
            <table class="table table-hover">
                <caption class="text-center"><h3>Електронна копія документа</h3></caption>
                <thead>
                <tr>
                    <th class="text-center">
                        @lang('ua.orderNumber')
                    </th>

                    <th class="text-center">
                        @lang('ua.fileName')
                    </th>

                    <th class="text-center">
                        @lang('ua.size')
                    </th>

                    <th class="text-center">
                        @lang('ua.Delete')
                    </th>
                </tr>
                </thead>

                <tbody>
                <?php $counter = 0; ?>
                @foreach($body as $item)
                    <tr>
                        <td>
                            {!! ++$counter !!}
                        </td>

                        <td>
                            {!! $item->original_name !!}
                        </td>

                        <td>
                            {!! $item->size !!}
                        </td>

                        <td class="text-center">
                            <form action="{{ route('manipulate_body', ['bodyId' => $item->id]) }}"
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

        @if(!$counter)
            {{--<!-- Button trigger modal -->--}}
                <button type="button" class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#addBody">
                    @lang('ua.AddBody')
                </button>

                {{--<!-- Modal -->--}}
                <div class="modal fade" id="addBody" tabindex="-1" role="dialog" aria-labelledby="addBody">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <form class="form"
                                  method="post"
                                  action="{{ route('manipulate_body') }}"
                                  enctype="multipart/form-data">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Форма завантаження документа</h4>
                                </div>
                                <div class="modal-body">

                                    {{ csrf_field() }}
                                    <input type="hidden" name="draftId" value="{{ $draftId }}">

                                    <div class="form-group">
                                        <label for="doc_body"><h1>Виберіть файл для завантаження</h1></label>
                                        <input type="file" id="doc_body" name="doc_body">
                                        <p class="help-block">Для завантаження файла необхідно натиснути на
                                            кнопку &laquo;Оберить файл&raquo;</p>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        @lang('ua.Cancel')
                                    </button>

                                    <button type="submit" class="btn btn-primary">
                                        @lang('ua.AddBody')
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

        @endif

        </div>
    </div>

    <div class="col-sm-10 col-sm-offset-1 col-md-offset-0 col-md-5">
        <div class="table-responsive">
            <table class="table table-hover">
                <caption class="text-center"><h3>Електронні копії додатків</h3></caption>
                <thead>
                <tr>
                    <th class="text-center">
                        @lang('ua.orderNumber')
                    </th>

                    <th class="text-center">
                        @lang('ua.fileName')
                    </th>

                    <th class="text-center">
                        @lang('ua.size')
                    </th>

                    <th class="text-center">
                        @lang('ua.Delete')
                    </th>
                </tr>
                </thead>

                <tbody>
                <?php $counter = 0; ?>
                @if(!empty($body))
                    @foreach($appendices as $appendix)
                        <tr>
                            <td>
                                {!! ++$counter !!}
                            </td>

                            <td>
                                {!! $appendix->original_name !!}
                            </td>

                            <td>
                                {!! $appendix->size !!}
                            </td>

                            <td class="text-center">
                                <form action="{{ route('manipulate_appendices', ['appendixId' => $appendix->id]) }}"
                                      method="post"
                                      class="form-horizontal">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="_method" value="delete">
                                    <button class="btn btn-danger" type="submit">@lang('ua.delete')</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            {{--<button type="button" class="btn btn-warning btn-lg btn-block">@lang('ua.AddAppendix')</button>--}}

                {{--<!-- Button trigger modal -->--}}
                <button type="button" class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#addAppendices">
                    @lang('ua.AddAppendix')
                </button>

                {{--<!-- Modal -->--}}
                <div class="modal fade" id="addAppendices" tabindex="-1" role="dialog" aria-labelledby="addAppendices">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <form class="form"
                                  method="post"
                                  action="{{ route('manipulate_appendices') }}"
                                  enctype="multipart/form-data">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Форма завантаження додатків</h4>
                                </div>
                                <div class="modal-body">

                                    {{ csrf_field() }}
                                    <input type="hidden" name="draftId" value="{{ $draftId }}">

                                    <div class="form-group">
                                        <label for="appendices"><h1>Оберіть файли для завантаження</h1></label>
                                        <input type="file" id="appendices" name="appendices[]" multiple>
                                        <p class="help-block">Для завантаження файлів необхідно натиснути на
                                            кнопку &laquo;Оберить файли&raquo;</p>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        @lang('ua.Cancel')
                                    </button>

                                    <button type="submit" class="btn btn-primary">
                                        @lang('ua.AddAppendix')
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
