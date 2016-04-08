@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Settings</div>
                <div class="panel panel-info">
                  <div class="panel-heading">API token</div>
                  <div class="input-group">
                    <input type="text" class="form-control" disabled value="{{ $user->api_token }}" aria-describedby="copy">
                    <div class="input-group-btn">
                      <button class="btn btn-default" id="copy">
                        <i class="glyphicon glyphicon-copy"></i>
                      </button>
                    </div>
                  </div>
                  <button class="btn btn-default" style="width:100%">Reset</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
