@extends('layouts.app')

@section('content')
<style type="text/css">
    html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: -webkit-box;
  display: flex;
  -ms-flex-align: center;
  -ms-flex-pack: center;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  justify-content: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 400px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

</style>
<body class="text-center">
<form class="form-signin" method="POST" action="{{ route('login') }}">
{{ csrf_field() }}
<h1 class="h3 mb-3 font-weight-normal">Please Login</h1>
@if ($errors->has('email'))
      <span class="help-block" >
          <font color=red><strong>{{ $errors->first('email') }}</strong></font>
      </span>
  @endif
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
  <label for="inputEmail" class="sr-only">Email address</label>
  <input id="inputEmail" type="email" class="form-control" placeholder="Email address" name="email" value="{{ old('email') }}" required autofocus>
  
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
  <label for="password" class="sr-only">Password</label>
  <input type="password" id="password"  class="form-control" name="password" required>

  @if ($errors->has('password'))
      <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
      </span>
  @endif
</div>

<div class="checkbox mb-3">
  <label><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me</label>
</div>
<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>

</form>
<p class="mt-5 mb-3 text-muted">&copy; {{date("Y")}}, Developed by Rahul Soni </p>
</body>
@endsection
