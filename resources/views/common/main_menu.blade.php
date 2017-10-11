<?php $prefix = Auth::user()->role_name . "_"; ?>

@if($mainMenu)
    @foreach($mainMenu as $name => $path)
        <li>
            <a href="{{ route($prefix . $path) }}"
               class="btn btn-default
                {{ (URL::current() == route($prefix . $path)) ? 'active' : '' }}">
                @lang('ua.' . $path)
            </a>
        </li>
    @endforeach
@endif