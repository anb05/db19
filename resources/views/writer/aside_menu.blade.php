<div>
    <ul class="nav nav-pills nav-stacked" role="tablist">
        @for($count = 0; $count < count($types); $count++)
            <li class="{{ ($count == 0) ? 'active' : '' }}" role="presentation">
                <a href="#{{ $types[$count] }}" aria-controls="{{ $types[$count] }}" role="tab" data-toggle="tab">
                    @lang('ua.' . $types[$count])
                </a>
            </li>
        @endfor
    </ul>
</div>