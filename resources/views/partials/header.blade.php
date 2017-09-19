<header class="navbar navbar-default header">
    <div class="container">
    	@if (!Auth::guest())
	        <div class="navbar-header">
	        	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
	                <span class="sr-only">Toggle Navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>

	            <a class="navbar-brand" href="{{ url('/') }}">
	                {{ config('app.name', 'Task Manager') }}
	            </a>
	        </div>

	        <div class="collapse navbar-collapse" id="app-navbar-collapse">
	            <ul class="nav navbar-nav">
	            	<li>
	            		<a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
	            	</li>
	            	@if (Auth::user()->role_id == 1)
	            	<li>
	            		<a href="{{ route('users') }}"><i class="fa fa-user"></i> Users</a>
	            	</li>
	            	@endif
	            </ul>

	            <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Hi {{ Auth::user()->name }}! <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                        	<li>
                                <a href="{{ route('setting') }}">
                                    Setting
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" >
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
	            </ul>
	        </div>
	    @else
	    	<div class="navbar-header">
	            <a class="navbar-brand" href="{{ url('/') }}">
	                {{ config('app.name', 'Task Manager') }}
	            </a>
	        </div>
        @endif
    </div>
</header>