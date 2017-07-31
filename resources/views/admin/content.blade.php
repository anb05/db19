<div class="row">
    @yield('status')
</div>

@if(!empty($users))
    @include('admin.view_user')
@endif
