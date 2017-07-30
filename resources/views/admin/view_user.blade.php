<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>{{ trans('ua.id') }}</th>
                <th>{{ trans('ua.Login') }}</th>
                <th>{{ trans('ua.Group') }}</th>
                <th>{{ trans('ua.Roles') }}</th>
                <th>{{ trans('ua.Delete') }}</th>
            </tr>
            </thead>

{{--            @if($users)--}}
                @foreach($users as $user)
                    <tr>
                        <td><a href="{{ route('userEdit', ['user' => $user->id]) }}">{{ $user->id }}</a></td>
                        <td><a href="{{ route('userEdit', ['user' => $user->id]) }}">{{ $user->login }}</a></td>
                        <td>{{ $user->group_name }}</td>
                        <td>{{ $user->role_name }}</td>
                        <td>
                            <form action="{{ route('userEdit', ['user' => $user->id]) }}"
                                  method="post"
                                  class="form-horizontal">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-danger" type="submit">@lang('ua.delete')</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            {{--@endif--}}
        </table>
    </div>
</div>
