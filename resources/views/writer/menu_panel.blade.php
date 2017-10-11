<?php $prefix = Auth::user()->role_name . "_"; ?>

<ul class="nav nav-tabs nav-justified" role="tablist">
    <li class="{{ $routeName == $prefix . 'create_doc' ? 'active' : '' }}" role="presentation">
        <a href="{{ route($prefix . 'create_doc') }}">

            @lang('ua.newDocument')

        </a>
    </li>

    <li class="{{ $routeName == $prefix . 'show_drafts' ? 'active' : '' }}" role="presentation">
        <a href="{{ route($prefix . 'show_drafts') }}">

            @lang('ua.draftDocument')

        </a>
    </li>

    @if(Auth::user()->role_name == 'moderator')
        <li class="{{ $routeName == $prefix . 'show_prepareds' ? 'active' : '' }}" role="presentation">
            <a href="{{ route($prefix . 'show_prepareds') }}">

                @lang('ua.preparedDocument')

            </a>
        </li>

        {{--<li class="{{ $routeName == $prefix . 'show_checked' ? 'active' : '' }}" role="presentation">--}}
            {{--<a href="">--}}

                {{--@lang('ua.checkedDocument')--}}

            {{--</a>--}}
        {{--</li>--}}
    @endif
</ul>
