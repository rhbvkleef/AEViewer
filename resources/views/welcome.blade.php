@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    <p>Here be useful information! (that's a lie...<sub>NO NO<sub>ITS A Cake!<sub>But still a lie!<sub>Yes, but cakes are nicer...<sub>but cakes are lies<sub>Here be dots:<sub>Nope<sub>Yes<sub>LIES<sub>Sure no!<sub>Still lies<sub>WHAT!?<sub>This is rediculous, shall we stop?<sub>NEVER<sub>uhh what?<sub>Nothing!<sub>SHUT UP YOU<sub>But.. But NOOOOOOO</sub></sub></sub></sub></sub></sub></sub></sub></sub></sub></sub></sub></sub></sub></sub></sub></sub></sub>)</p>
                    <p>
                        Anyway! If you need any help, you can go to the <a href="{{ route('ae.doc') }}">help page</a>. To view an AE system, you can view the <a href="{{ route('ae.all') }}">list</a>.
                    </p>
                    <p>
                        If you want to contribute, please send an email to <a href="mailto:rhbvkleef+aeviewer@gmail.com">rhbvkleef+aeviewer@gmail.com</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
