@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">How to: </div>
                <ul class="list-group">
                  <li class="list-group-item"><a href="#in-game-config">Download computercraft program</a></li>
                  <li class="list-group-item"><a href="#contribute">Contributing</a></li>
                  <li class="list-group-item"><a href="#security">Security</a></li>
                </ul>
                <div class="panel panel-info" id="in-game-config">
                    <div class="panel-heading">Download computercraft program</div>
                    <div class="panel-body">
                      <p>Fist you need to make sure you have enabled the HTTP API in the computercraft config file. (It should be enabled by default.) Then place a computer next to any AE network component (a wire, controller, storage monitor, anything) and start it up.</p>
                      <p>You can download the computercraft program by entering the following command:</p>
                      <p>
                        <code>
                          pastebin get ... startup
                        </code>
                      </p>
                      <p>Then simply open the program by entering:</p>
                      <p>
                        <code>
                          edit startup
                        </code>
                      </p>
                      <p>and enter your credentials. After that, simply start the program by typing: </p>
                      <p>
                        <code>
                          startup
                        </code>
                      </p>
                    </div>
                </div>
                <div class="panel panel-info" id="contribute">
                  <div class="panel-heading">Contributing</div>
                  <div class="panel-body">
                    At this moment, you may only contribute with my permission.
                    If you have any ideas, contributions, complaints or anything else,
                    feel free to contact me at: <a href="mailto:rhbvkleef+aeviewer@gmail.com">rhbvkleef+aeviewer@gmail.com</a>
                  </div>
                </div>
                <div class="panel panel-info" id="security">
                  <div class="panel-heading">Security</div>
                  <div class="panel-body">
                    There are currently a few security flaws in the way this program works.
                    <p>
                      As you may have noticed, you need to enter your login password in plaintext on your computercraft computer. This is obviously very insecure. I have a few very elaborate ways to fix it, but I am sure your ideas must be much better. Again: Please email them to <a href="mailto:rhbvkleef+aeviewer@gmail.com">rhbvkleef+aeviewer@gmail.com</a>
                    </p>
                    <p>
                      On server side, your password is stored in a secure hashed format: I do not, and cannot know your password. I will not publish the specific crypto I am using, but rest assured it is going to take until the end of the universe to crack it. This does not mean you should do any of the following:
                      <ul class="list-group">
                        <ul class="list-group-item">Use weak passwords</ul>
                        <ul class="list-group-item">Reuse passwords</ul>
                        <ul class="list-group-item">Publish passwords</ul>
                        <ul class="list-group-item">Store passwords in plaintext on your computer</ul>
                      </ul>
                    </p>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('head')
<style media="screen">
  .list-group-condensed > .list-group-item {
    padding: 3px 10px;
  }
</style>
@endsection
