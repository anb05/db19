<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover table-striped">
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
                        <td>{{ 'delete' }}</td>

                    </tr>
                @endforeach
            {{--@endif--}}
        </table>
    </div>
</div>
