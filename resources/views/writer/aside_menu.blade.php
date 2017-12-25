<div>
    {{-- Nav tabs to form_create_doc --}}
    <ul class="nav nav-pills nav-stacked">
        @foreach($types as $type)
            <li class="{{ ($defaultType == $type->name) ? 'active' : '' }}"
                role="presentation">

                <a href="{{ route($routeName, ['document_type' => $type->name]) }}">

                    {{ $type->alias }}

                </a>
            </li>
        @endforeach
    </ul>
</div>