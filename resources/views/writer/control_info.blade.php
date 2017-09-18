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
                <tr>
                    <td>
                        Number
                    </td>

                    <td>
                        Date
                    </td>

                    <td>
                        responsible Executor
                    </td>

                    <td>
                        Date Execute
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
            <button type="button" class="btn btn-warning btn-lg btn-block">@lang('ua.AddControl')</button>
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
