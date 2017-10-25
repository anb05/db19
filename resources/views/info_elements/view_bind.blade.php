<div class="row">
    <div class="col-sm-10 col-sm-offset-1 col-md-offset-1 col-md-10">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="text-center">Надання доступу до документу</h3>
            </div>

            <div class="panel-body db-background">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>Номер за порядком</th>
                            <th>Найменування групи</th>
                            <th>Короткий опис групи</th>
                            <th>Доступ</th>
                        </tr>
                        <?php $counter = 0; ?>
                        @foreach($groups as $group)
                            @continue(($group->name === 'guest') || ($group->name === 'admin'))
                            <tr>
                                <th>{{ ++$counter }}</th>
                                <th>{!! $group->name !!}</th>
                                <th>{!! $group->description !!}</th>
                                <th>
                                    <input type="checkbox"
                                           name="select_group[]"
                                           value="{{ $group->name }}"
                                           form="change_access"
                                           {{ $activeGroups->contains($group->name) ? 'checked' : '' }}

                                            {{-- ($group->name === 'leadership') ? 'checked' : '' --}} >
                                </th>
                            </tr>
                        @endforeach
                    </table>
                    <form action="{{ route('bind_document_with_group', ['documentId' => $document->id]) }}"
                          method="post"
                          class="form-horizontal"
                          id="change_access">

                        {{ csrf_field() }}

                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Змінити доступ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>