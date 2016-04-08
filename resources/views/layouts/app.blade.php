<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>AE Viewer</title>

  <!-- Fonts -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

  <!-- Styles -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  @yield('head')
  <style>
  body {
    font-family: 'Lato';
  }

  .fa-btn {
    margin-right: 6px;
  }
  </style>
  <script type="text/javascript">
  var debounce = 0;

  $(document).on("keyup paste", function() {
    if(debounce > 0)
    clearTimeout(debounce);

    var search = $("#searchUsers");

    var data = {"search": search.val()};

    debounce = setTimeout(function() {
      $.post(
        "{{ route('ae.api.search.suggest') }}",
        data,
        function (json) {
          search.autocomplete({
            source: json,
            select: function(event, ui) {
              window.location.href = ui.item.link;
              return false;
            }
          });
        }
        , 'json'
      );
    }, 250);
  });
  </script>
</head>
<body id="app-layout">
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">

        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
          AE viewer
        </a>
      </div>

      <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
          <li><a href="{{ route('ae.all') }}">List</a></li>
          <li><a href="{{ route('ae.doc') }}">Help</a></li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
          <li>
            <form action="{{ route('ae.search') }}" method="POST" class="navbar-form" role="search" autocomplete="off">
              {{ csrf_field() }}
              <div class="input-group">
                <input placeholder="Search" type="text" class='form-control' id='searchUsers' name='search' autocomplete="off">
                <div class="input-group-btn">
                  <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
              </div>
            </form>
          </li>
          <!-- Authentication Links -->
          @if (!Auth::check())
          <li><a href="{{ url('/login') }}">Login</a></li>
          <li><a href="{{ url('/register') }}">Register</a></li>
          @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ route('ae.view', ['user' => Auth::user()->id]) }}"><i class='fa fa-btn fa-list'></i>View AE system</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ route('user.settings') }}"><i class="fa fa-btn fa-cog"></i>Settings</a></li>
              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
            </ul>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')

  <!-- JavaScripts -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
