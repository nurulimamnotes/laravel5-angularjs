<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>BITS Applications - Sistem Pendukung Keputusan SAW</title>
  <meta name="description" content="Angularjs, Html5, Music, Landing, 4 in 1 ui kits package" />
  <meta name="keywords" content="AngularJS, angular, bootstrap, admin, dashboard, panel, app, charts, components,flat, responsive, layout, kit, ui, route, web, app, widgets" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="/bower_components/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="/bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="/css/font.css" type="text/css" />
  <link rel="stylesheet" href="/css/app.css" type="text/css" />
</head>
<body>
<div class="container w-xxl w-auto-xs">
  <a href class="navbar-brand block m-t">BITS Applications</a>
  <div class="m-b-lg">
    <div class="wrapper text-center">
      <strong>Insert your email to reset password.</strong>
    </div>

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="list-group list-group-sm">
        <div class="list-group-item">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>
      </div>
      <button type="submit" class="btn btn-lg btn-primary btn-block">Reset Password</button>
      <div class="line line-dashed"></div>
      <p class="text-center"><small>Do not have an account ?</small></p>
      <a ui-sref="access.signup" class="btn btn-lg btn-default btn-block">Create an account</a>
      <div class="line line-dashed"></div>
      <p class="text-center"><small>or login to your account.</small></p>
      <a href="/auth/login" class="btn btn-lg btn-default btn-block">Login</a>
    </form>
  </div>
  <div class="text-center">
  </div>
</div>
</body>
</html>