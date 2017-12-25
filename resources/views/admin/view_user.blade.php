<div class="container">
    <div class="row">
        <ul class="pager">
            <li class="next">
                <a href="{{ route('admin_read_user', ['param' => 'withDelete']) }}">
                    <span aria-hidden="true">
                        @lang('ua.viewDelete')
                    </span>
                </a>
            </li>
        </ul>
        <table class="table table-hover">
            <thead>
            <tr>
<<<<<<< HEAD
                <th class="col-md-2 text-center">
                    <a href="{{ route('read_user', ['param' => 'id']) }}">
=======
                <th class="col-md-1 text-center">
                    <a href="{{ route('admin_read_user', ['param' => 'id']) }}">
>>>>>>> writer_fix
                        {{ trans('ua.id') }}
                    </a>
                    @if($columnSort == 'id')
                        @if($directionSort === 'desc')
                            <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                        @else
                            <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                        @endif
                    @else
                        <span class="glyphicon glyphicon-sort" aria-hidden="true"></span>
                    @endif
                </th>

                <th class="col-md-2 text-center">
<<<<<<< HEAD
                    <a href="{{ route('read_user', ['param' => 'login']) }}">
=======
                    <a href="{{ route('admin_read_user', ['param' => 'login']) }}">
>>>>>>> writer_fix
                        {{ trans('ua.Login') }}
                    </a>
                    @if($columnSort == 'login')
                        @if($directionSort === 'desc')
                            <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                        @else
                            <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                        @endif
                    @else
                        <span class="glyphicon glyphicon-sort" aria-hidden="true"></span>
                    @endif
                </th>

<<<<<<< HEAD
                <th class="col-md-2 text-center">
                    <a href="{{ route('read_user', ['param' => 'full_name']) }}">
                        {{ trans('ua.FullName') }}
=======
                <th class="col-md-3 text-center">
                    <a href="{{ route('admin_read_user', ['param' => 'full_name']) }}">
                        {{ trans('ua.fullName') }}
>>>>>>> writer_fix
                    </a>
                    @if($columnSort == 'full_name')
                        @if($directionSort === 'desc')
                            <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                        @else
                            <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                        @endif
                    @else
                        <span class="glyphicon glyphicon-sort" aria-hidden="true"></span>
                    @endif
                </th>

                <th class="col-md-1 text-center">
<<<<<<< HEAD
                    <a href="{{ route('read_user', ['param' => 'group_name']) }}">
=======
                    <a href="{{ route('admin_read_user', ['param' => 'group_name']) }}">
>>>>>>> writer_fix
                        {{ trans('ua.Group') }}
                    </a>
                    @if($columnSort == 'group_name')
                        @if($directionSort === 'desc')
                            <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                        @else
                            <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                        @endif
                    @else
                        <span class="glyphicon glyphicon-sort" aria-hidden="true"></span>
                    @endif
                </th>

                <th class="col-md-1 text-center">
<<<<<<< HEAD
                    <a href="{{ route('read_user', ['param' => 'role_name']) }}">
=======
                    <a href="{{ route('admin_read_user', ['param' => 'role_name']) }}">
>>>>>>> writer_fix
                        {{ trans('ua.Roles') }}
                    </a>
                    @if($columnSort == 'role_name')
                        @if($directionSort === 'desc')
                            <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                        @else
                            <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                        @endif
                    @else
                        <span class="glyphicon glyphicon-sort" aria-hidden="true"></span>
                    @endif
                </th>

                <th class="col-md-2 text-center">
<<<<<<< HEAD
                    <a href="{{ route('read_user', ['param' => 'created_at']) }}">
=======
                    <a href="{{ route('admin_read_user', ['param' => 'created_at']) }}">
>>>>>>> writer_fix
                        {{ trans('ua.Registered') }}
                    </a>
                    @if($columnSort == 'created_at')
                        @if($directionSort === 'desc')
                            <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                        @else
                            <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                        @endif
                    @else
                        <span class="glyphicon glyphicon-sort" aria-hidden="true"></span>
                    @endif
                </th>

                <th class="col-md-2 text-center">
<<<<<<< HEAD
                    <a href="{{ route('read_user', ['param' => 'updated_at']) }}">
=======
                    <a href="{{ route('admin_read_user', ['param' => 'updated_at']) }}">
>>>>>>> writer_fix
                        {{ trans('ua.Updated') }}
                    </a>
                    @if($columnSort == 'updated_at')
                        @if($directionSort === 'desc')
                            <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                        @else
                            <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                        @endif
                    @else
                        <span class="glyphicon glyphicon-sort" aria-hidden="true"></span>
                    @endif
                </th>

                <th class="col-md-2 text-center">{{ trans('ua.Delete') }}</th>
            </tr>
            </thead>

            @foreach($users as $user)
                <tr>
                    <td><a href="{{ route('userEdit', ['user' => $user->id]) }}">{{ $user->id }}</a></td>
                    <td><a href="{{ route('userEdit', ['user' => $user->id]) }}">{{ $user->login }}</a></td>
                    <td>{{ $user->full_name }}</td>
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
        </table>

        <nav aria-label="Page navigation" class="navbar navbar-fixed-bottom">
            <div class="container">
{{--                {{ $users->links() }}--}}
                {{ $users->withPath(route('admin_read_user')) }}
            </div>
        </nav>
    </div>
</div>
