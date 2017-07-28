<div class="panel panel-default">
    <div class="panel-heading">@lang('ua.User data for the documents')</div>
    <div class="panel-body">

        <div class="form-group">
            <label for="group" class="col-md-4 control-label">{{ trans('ua.Group') }}</label>

            @if(!empty($groups))
                <div class="col-md-6">
                    <select id="group" name="group" class="input-group dropdown-menu dropdown-menu-righ">
                        @foreach($groups as $group)
                            <option {{ ($oldUserData['group_name'] == $group) ? 'selected' : '' }}>{{ trans('ua.' . $group) }}</option>
                        @endforeach
                    </select>
                    {{--<input id="id" type="text" class="form-control" name="id" value="{{ $oldUserData['id'] }}">--}}

                    {{--@if ($errors->has('id'))--}}
                    {{--<span class="help-block">--}}
                    {{--<strong>{{ $errors->first('id') }}</strong>--}}
                    {{--</span>--}}
                    {{--@endif--}}
                </div>
            @endif
        </div>

        <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
            <label for="role" class="col-md-4 control-label">{{ trans('ua.Roles') }}</label>

            @if(!empty($roles))
                <div class="col-md-6">
                    <select id="role" name="role" class="input-group dropdown-menu dropdown-menu-righ">
                        @foreach($roles as $role)
                            <option {{ ($oldUserData['role_name'] == $role) ? 'selected' : '' }}>{{ trans('ua.' . $role) }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            {{--<div class="col-md-6">--}}
            {{--<input id="login" type="text" class="form-control" name="login" value="{{ $oldUserData['login'] }}">--}}

            {{--@if ($errors->has('login'))--}}
            {{--<span class="help-block">--}}
            {{--<strong>{{ $errors->first('login') }}</strong>--}}
            {{--</span>--}}
            {{--@endif--}}
            {{--</div>--}}
        </div>


        <div class="form-group{{ $errors->has('passwordDb') ? ' has-errorDb' : '' }}">
            <label for="passwordDb" class="col-md-4 control-label">@lang('ua.Password')</label>

            <div class="col-md-6">
                <input id="passwordDb" type="password" class="form-control" name="passwordDb">

                @if ($errors->has('passwordDb'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('passwordDb') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirmDb" class="col-md-4 control-label">@lang('ua.Confirm Password')</label>

            <div class="col-md-6">
                <input id="password-confirmDb" type="password" class="form-control" name="password_confirmationDb">
            </div>
        </div>
    </div>
</div>
