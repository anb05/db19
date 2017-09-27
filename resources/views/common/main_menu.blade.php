@if($mainMenu)
    @if(Auth::user()->role_name === 'moderator')
        <?php $prefix = 'moderator_'; ?>
    @else
        <?php $prefix = ''; ?>
    @endif
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