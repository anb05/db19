@if($mainMenu)
    @foreach($mainMenu as $name => $path)
        <li>
            <a href="{{ route($path) }}"
               class="btn btn-default btn-xs
                {{ (URL::current() == route($path)) ? 'active' : '' }}">{{ $name }}</a>
        </li>
    @endforeach
@endif