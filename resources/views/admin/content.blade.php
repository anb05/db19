<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">

                    Dashboard

                    @yield('status')

                </div>
            </div>
        </div>
    </div>
    @if(!empty($users))
        @include('admin.view_user')
    @endif
</div>
