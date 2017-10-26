<div class="row">
    <div class="col-sm-10 col-sm-offset-1 col-md-offset-1 col-md-10">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="text-center">Перегляд електронних копій</h3>
            </div>

            <div class="panel-body db-background">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Основний документ</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th>Назва файлу</th>
                                    <th>Тип файлу</th>
                                    <th>Розмір файлу</th>
                                    <th>Переглянути</th>
                                </tr>
                                <tr>
                                    <td>
                                        {!! $body->original_name !!}
                                    </td>
                                    <td>
                                        {!! $body->mime_type !!}
                                    </td>
                                    <td>
                                        {!! $body->size !!}
                                    </td>
                                    <td>
                                        <form action="{{ route('view_body',['bodyId' => $body->id]) }}"
                                              method="post"
                                              target="_blank"
                                              class="form-horizontal">

                                            {{ csrf_field() }}

                                            <input type="hidden" name="body_id" value="{{ $body->id }}">
                                            <button class="btn btn-primary" type="submit">Переглянути</button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Додатки</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th>Назва файлу</th>
                                    <th>Тип файлу</th>
                                    <th>Розмір файлу</th>
                                    <th>Переглянути</th>
                                </tr>

                                @foreach($appendices as $appendix)
                                    <tr>
                                        <td>
                                            {!! $appendix->original_name !!}
                                        </td>
                                        <td>
                                            {!! $appendix->mime_type !!}
                                        </td>
                                        <td>
                                            {!! $appendix->size !!}
                                        </td>
                                        <td>
                                            <form action="{{ route('view_appendix', ['$appendixId' => $appendix->id]) }}"
                                                  method="post"
                                                  target="_blank"
                                                  class="form-horizontal">

                                                {{ csrf_field() }}

                                                <input type="hidden" name="appendix_id" value="{{ $appendix->id }}">
                                                <button class="btn btn-primary" type="submit">Переглянути</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>