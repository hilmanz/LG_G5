@extends('layout')


@section('content')
<div class="container">
<div class="col-md-5 col-md-offset-3">
<h2>Login</h2>
<p>Hi, here you can login to your account. Just fill in the form and press Sign In button.</p>
		<br>
<hr />

 @if(Session::has('pesan_error'))
   {{ Session::get('pesan_error') }}
 @endif

{{Form::open(array('action' => 'UsersController@authenticate')) }}
{{Form::label('email', 'Email') }}
{{Form::text('email', '', array('class' => 'form-control'))}}
<br />
{{Form::label('password', 'Password') }}
{{Form::password('password', array('class' => 'form-control'))}}
<br />
{{Form::submit('Sign in', array('class' => 'btn btn-primary')) }}
{{Form::close() }}

</div>
</div>
@stop