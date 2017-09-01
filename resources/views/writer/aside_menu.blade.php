<div>
    {{-- Nav tabs to form_create_doc --}}
    <ul class="nav nav-pills nav-stacked">

        @foreach($types as $type)
            <li class="{{ ($defaultType == $type->name) ? 'active' : '' }}"
                role="presentation">

                <a href="{{ route('create_doc', ['document_type' => $type->name]) }}">

                    {{ $type->alias }}

                </a>
            </li>
        @endforeach




        {{--@for($count = 0; $count < count($types); $count++)--}}
            {{--<li class="{{ ($count == \Config::get('db19.startBook')) ? 'active' : '' }}"--}}
                {{--role="presentation">--}}
{{----}}
                {{--<a href="{{ route('create_doc', ['document_type' => $types[$count]->name]) }}">--}}
{{----}}
                    {{--{{ $types[$count]->alias }}--}}
{{----}}
                {{--</a>--}}
            {{--</li>--}}
        {{--@endfor--}}
    </ul>
</div>