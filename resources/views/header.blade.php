<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">
                <img alt="Brand" src="/img/brand.png" width="21" height="28">
            </a>
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- /.navbar--->    
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="nav navbar-nav">
                <li><a href="/">Rank List</a></li>
                @if (Auth::check())
                <li><a href="/create">Create</a></li>
                @endif
                <li><a href="/help">Help</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login</a>
                        <ul class="dropdown-menu login">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! Form::open(['action' => 'AuthController@authenticate']) !!}
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" placeholder="Email address" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <label>
                                                  <input type="checkbox" name="rememberMe"> Remember me
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-block">Sign in</button>
                                            </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="/logout">Logout</a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
