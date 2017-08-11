@if($mainMenu)
    @foreach($mainMenu as $name => $path)
        <li>
            <a href="{{ route($path) }}"
               class="btn btn-default
                {{ (URL::current() == route($path)) ? 'active' : '' }}">
                @lang('ua.' . $path)
            </a>
        </li>
    @endforeach
@endif