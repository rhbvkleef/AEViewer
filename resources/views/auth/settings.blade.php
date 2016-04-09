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
                        <input type="text" class="form-control" id="token" disabled value="{{ $user->api_token }}" aria-describedby="copy-token">
                        <div class="input-group-btn">
                            <button class="btn btn-default" id="copy-token">
                                <i class="glyphicon glyphicon-copy"></i>
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-default" id="reset-token" style="width:100%">Reset</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('head')
<script>
$(document).ready(function() {
    $('#copy-token').click(function() {
        window.prompt("Copy to clipboard: Ctrl+C, Enter", $('#token')[0].value);
    });

    $('#reset-token').click(function() {
        var csrf = '{{ csrf_field() }}';
        var url = "{{ route('user.settings.reset') }}";
        var form = $(
            '<form action="' + url + '" method="post">' +
            csrf +
            '</form>'
        );
        $('body').append(form);
        form.submit();
    });
});

</script>
@endsection
