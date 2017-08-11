<div class="container">
    {{--<div class="row">--}}
    {{--</div>--}}
    <div class="row">
        <ul class="pager">
            <li class="next"><a href="{{ route('read_user', ['withDelete' => true]) }}"><span aria-hidden="true">@lang('ua.viewDelete')</span> </a></li>
        </ul>
        {{--<div class="col-lg-12">--}}
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="col-md-2">{{ trans('ua.id') }}</th>
                <th class="col-md-2">{{ trans('ua.Login') }}</th>
                <th class="col-md-1">{{ trans('ua.Group') }}</th>
                <th class="col-md-1">{{ trans('ua.Roles') }}</th>
                <th class="col-md-2">{{ trans('ua.Registered') }}</th>
                <th class="col-md-2">{{ trans('ua.Updated') }}</th>
                <th class="col-md-2">{{ trans('ua.Delete') }}</th>
            </tr>
            </thead>

            {{--            @if($users)--}}
            @foreach($users as $user)
                <tr>
                    <td><a href="{{ route('userEdit', ['user' => $user->id]) }}">{{ $user->id }}</a></td>
                    <td><a href="{{ route('userEdit', ['user' => $user->id]) }}">{{ $user->login }}</a></td>
                    <td>{{ $user->group_name }}</td>
                    <td>{{ $user->role_name }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>
                        <form action="{{ route('userEdit', ['user' => $user->id]) }}"
                              method="post"
                              class="form-horizontal">
                            {{ csrf_field() }}
                            @if(is_null($user->deleted_at))
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-danger" type="submit">@lang('ua.delete')</button>
                            @else
                                {{--<input type="hidden" name="restored" value="restored">--}}
                                <input type="hidden" name="_method" value="restore">
                                <button class="btn btn-success" type="submit">@lang('ua.restore')</button>
                            @endif
                        </form>
                    </td>

                </tr>
            @endforeach
            {{--@endif--}}
        </table>



        <nav aria-label="Page navigation" class="navbar navbar-fixed-bottom">
            <div class="container">
                {{ $users->links() }}
            </div>
        </nav>



        {{--</div>--}}
    </div>
</div>
