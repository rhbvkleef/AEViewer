@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">AE system from {{$user->name}}</div>

                <ul class="list-group">
                    <li class="list-group-item">Total items: {{$total}}</li>
                    <li class="list-group-item">Total types: {{$types}}</li>
                    <li class="list-group-item">Last updated at: {{ $user->updated_at }} ({{$timezone}})<a href="{{ Request::url() }}" class="pull-right"><i class="glyphicon glyphicon-refresh"></i></a></li>
                </ul>

                <div class="panel-body">
                    <div class="input-group">
                        <input placeholder="search" type="text" class='form-control' id='searchTable'>
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-search"></i>
                        </div>
                    </div>
                </div>
                <table id="itemList" class="table table-condensed table-hover sortable-theme-bootstrap" data-sortable>
                    <thead>
                        <th>Name</th><th>ID</th><th>dmg</th><th>amount</th>
                    </thead>
                    <tbody>
                        @foreach($aesystem as $item)
                            <tr>
                                <td style="font-weight:bold;">{{urldecode($item->display_name)}}</td>
                                <td>{{ $item->fingerprint->id }}</td>
                                <td>{{ $item->fingerprint->dmg }}</td>
                                <td>
                                    {{ $item->size }}
                                    @if( $item->is_fluid )
                                        mB
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    var $rows = $('#itemList tbody tr');
    $('#searchTable').keyup(function() {
        var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
            reg = RegExp(val, 'i'),
            text;

        $rows.show().filter(function() {
            var matches = false;
            $(this).children().each(function() {
                text = $(this).text().replace(/\s+/g, ' ');
                if(reg.test(text)) {
                    matches = true;
                }
            });
            return !matches;
        }).hide();
    });
</script>
@endsection

@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/sortable/0.8.0/css/sortable-theme-bootstrap.min.css" rel='stylesheet' type='text/css'/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sortable/0.8.0/js/sortable.min.js"></script>
@endsection
