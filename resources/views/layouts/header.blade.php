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
                <li><a href="/chart">Chart</a></li>
                @if (Auth::check())
                    @can('isAdmin', Auth::user())
                        <li><a href="/create">Create</a></li>
                        <li><a href="/batch">Batch Mode</a></li>
                    @endcan
                @endif
                <li><a href="/achievements">Hall of Fame</a></li>
                <li><a href="/help">Help</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                <li>
                    <a href="/user/add">Register</a>
                </li>
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
                                        <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                            Forgot Your Password?
                                        </a>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hi, <?php echo Auth::user()->name ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu loggedin">
                        @can('isAdmin', Auth::user())
                            <li>
                            <?php
                            $msgs_amt = App\User::adminGetNumberOfUnreadMsg();
                            if ($msgs_amt != 0) {
                            ?>
                                <a href="/messages">Messages <span class="label label-danger label-as-badge"><?php echo $msgs_amt ?></span></a>
                            <?php
                            } else {
                            ?>
                                <a href="/messages">Messages <span class="label label-default label-as-badge">0</span></a>
                            <?php
                            }
                            ?>
                            </li>
                        @endcan
                        @can('isUser', Auth::user())
                        <li>
                            <a href="/messages">Messages</a>
                        </li>
                        @endcan
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="/logout">Logout</a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
