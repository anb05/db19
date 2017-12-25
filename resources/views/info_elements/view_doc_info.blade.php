<div class="row">
    <div class="col-sm-10 col-sm-offset-1 col-md-offset-1 col-md-10">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="text-center">Відомості про документ</h3>
            </div>

            <div class="panel-body db-background">
                @foreach($orderColumns as $column)
                    <div class="panel panel-info">
                        <div class="panel-heading"><h4>{!! $columnNames->$column !!}</h4></div>
                        <div class="panel-body">
                            @if(($column === 'num') || ($column === 'date') || ($column === 'type_name'))
                                {!! $reg->$column !!}
                            @else
                                {!! $document->$column !!}
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
