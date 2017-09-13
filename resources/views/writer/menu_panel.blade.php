<ul class="nav nav-tabs nav-justified" role="tablist">
    <li class="{{ $routeName == 'create_doc' ? 'active' : '' }}" role="presentation">
        <a href="{{ route('create_doc') }}">

            @lang('ua.newDocument')

        </a>
    </li>

    <li class="{{ $routeName == 'show_drafts' ? 'active' : '' }}" role="presentation">
        <a href="{{ route('show_drafts') }}">

            @lang('ua.draftDocument')

        </a>
    </li>

    <li class="{{ $routeName == 'show_prepares' ? 'active' : '' }}" role="presentation">
        <a href="">

            @lang('ua.preparedDocument')

        </a>
    </li>

    <li class="{{ $routeName == 'show_checked' ? 'active' : '' }}" role="presentation">
        <a href="">

            @lang('ua.checkedDocument')

        </a>
    </li>
</ul>
