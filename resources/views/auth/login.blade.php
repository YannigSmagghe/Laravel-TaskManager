@extends('layout')

@section('content')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
	<h1 class="col-xs-12 col-sm-10 col-sm-offset-1 main-title"> Task Manager</h1>
	<div class="container login">
		<div class="absolute center_screen login_from">
			<div class="title">
				<div><i class="fa fa-lock"></i> LogIn</div>
			</div>
			<form id="login">
				{{ csrf_field() }}
				<div class="container-fluid">					
					<div class="row">
						<div class="col-sm-12">
							<input type="text" name="username" placeholder="username" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<input type="password" name="password" placeholder="Password" />	
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<a class="btn btn-login"><i class="fa fa-lock" aria-hidden="true"></i> LogIn</a>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<a class="btn btn-register"><i class="fa fa-sign-in" aria-hidden="true"></i> Register</a>
						</div>
					</div>
				</div>				
			</form>
		</div>
	</div>
	<a id="register" class="btn btn-add_new_user_form pull-right hidden" href="#add_new_user_form_guest" role="button" data-toggle="modal" title="Create New User"><i class="fa fa-plus" aria-hidden="true"></i></a>

	<script type="text/javascript" src="js/login.js"></script>
	<script type="text/javascript" src="js/register.js"></script>

	@include('forms.add_new_user_form_guest')

@endsection