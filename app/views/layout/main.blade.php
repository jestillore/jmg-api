<!DOCTYPE html>
<html ng-app="JMG">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>JMG</title>
	<link rel="stylesheet" type="text/css" href="{{URL::to('css/yeti.css');}}" />
	<link rel="stylesheet" type="text/css" href="{{URL::to('css/normalize.css');}}" />
	<link rel="stylesheet" type="text/css" href="{{URL::to('css/jmg.css');}}" />
	@yield('css')
</head>
<body>
	<div id="banner" class="text-centered">
		<div class="container">
			<div class="row text-center">
				<img src="img/header-logo.png" />
			</div>
			<div id="main-nav" class="navbar navbar-default navbar-static-top" role="navigation" >
		        <div class="navbar-header">
		        	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
		            	<span class="sr-only">Toggle navigation</span>
		            	<span class="icon-bar"></span>
		            	<span class="icon-bar"></span>
		            	<span class="icon-bar"></span>
		          	</button>
		        </div>
	        	<div class="navbar-collapse collapse">
		          	<ul class="nav navbar-nav navbar-left">
		            	<li @if($active == 'home') class="active" @endif><a href="{{URL::to('/')}}">HOME</a></li>
		            	<li @if($active == 'about') class="active" @endif><a href="{{URL::to('about')}}">ABOUT US</a></li>
		            	<li @if($active == 'job-posting') class="active" @endif><a href="{{URL::to('job-posting')}}">JOB POSTING</a></li>
		            	<li @if($active == 'q-and-a') class="active" @endif><a href="{{URL::to('q-and-a')}}">Q &amp; A</a></li>
		            	<li @if($active == 'contact') class="active" @endif><a href="{{URL::to('contact')}}">CONTACT US</a></li>
		          	</ul>
		          	<ul class="nav navbar-nav navbar-right">
		            	<li>
		            		<div class="btn-group">
		            			@if(Auth::guest())
		            			<a class="btn btn-primary" href="{{URL::to('login')}}">LOGIN</a>
		            			<a class="btn btn-info" href="{{URL::to('signup')}}">SIGNUP</a>
		            			@elseif(Auth::check())
		            			<a class="btn btn-danger" href="{{URL::to('logout')}}">LOGOUT</a>
		            			@endif
		            		</div>
		            	</li>
		          	</ul>
	        	</div><!--/.nav-collapse -->
	      	</div>
		</div>
	</div>
	<div class="container">
		<div id="main-content">
			<div class="row">
				@yield('content')
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{{URL::to('js/jquery-1.11.1.js');}}"></script>
	<script type="text/javascript" src="{{URL::to('js/bootstrap.js');}}"></script>
	@yield('js')
</body>
</html>
