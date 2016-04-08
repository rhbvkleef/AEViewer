@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Search results</div>
                <ul class="list-group">
                    @foreach($users as $user)
                    <li class="list-group-item"><a href="{{ route('ae.view', ['user' => $user->id]) }}">{{$user->name}}</a></li>
                    @endforeach
                </ul>
                <?php $paginate_links = $users->render(); ?>
                @if($paginate_links)
                <div class="panel-body">
                    {!! $paginate_links !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
