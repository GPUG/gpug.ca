<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <link rel="icon" href="/img/favicon.png">

  <title>GPUG - @yield('title')</title>

  <!-- Bootstrap core CSS -->
  <link href="/css/app.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-header">
        <a class="navbar-brand brand-logo" href="/"><img src="/img/id.svg" class="img-responsive" width="250" alt="Guelph php user group"/></a>
      </div>
      @if (! Auth::check())
      <a class="btn btn-join navbar-btn pull-right" href="/auth/login">Sign in with Meetup</a> @else
      <ul class="navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img id="user-menu" src="{{ Auth::user()->avatar }}" alt="Signed in as {{ Auth::user()->name }}" class="img-square img-profile"/>
                    </a>
          <ul class="dropdown-menu" aria-labelledby="user-menu">
            <li><a href="/auth/logout">Sign out</a></li>
          </ul>
        </li>
        <ul>
          @endif
  </nav>

  <div class="jumbotron">
    <div class="container">
      @yield('content')
    </div>
  </div>

  <footer class="footer">
    <div class="container">
      <p>{{ $copyright }} GPUG.ca</p>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
</body>

</html>
