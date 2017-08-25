<div>
    {{-- Nav tabs to form_create_doc --}}
    <ul class="nav nav-pills nav-stacked" role="tablist">
        @for($count = 0; $count < count($types); $count++)
            <li class="{{ ($count == \Config::get('db19.startBook')) ? 'active' : '' }}" role="presentation">
                <a href="#{{ $types[$count]->name }}"
                   aria-controls="{{ $types[$count]->name }}"
                   role="tab"
                   data-toggle="pill">

                    {{ $types[$count]->alias }}

                </a>
            </li>
        @endfor
    </ul>
</div>