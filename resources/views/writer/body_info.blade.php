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
                <tr>
                    <td>
                        Order Number
                    </td>

                    <td>
                        File name
                    </td>

                    <td>
                        File size
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
            <button type="button" class="btn btn-warning btn-lg btn-block">@lang('ua.AddBody')</button>
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
                <tr>
                    <td>
                        Order Number
                    </td>

                    <td>
                        File name
                    </td>

                    <td>
                        File size
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
            <button type="button" class="btn btn-warning btn-lg btn-block">@lang('ua.AddAppendix')</button>
        </div>
    </div>
</div>
