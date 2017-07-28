@if($mainMenu)
    @foreach($mainMenu as $name => $path)
        <li>
            <a href="{{ route($path) }}">{{ $name }}</a>
        </li>
    @endforeach
@endif