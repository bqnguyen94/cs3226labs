<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CS3226 Labs</title>
		
		<link rel="stylesheet" type="text/css" href="/css/social.css" />
        <link rel="icon" type="image/png" href="/img/brand.png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="/css/style.css" />
        @yield('link')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="/js/fade.js"></script>
        <script type="text/javascript" src="/js/moveUp.js"></script>
    </head>
    <body>
    <script>
        notDisplay();
    </script>
        @include('layouts.header')
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissable fade in" role="alert" align="center">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>{{ Session::get('error') }}</strong>
            </div>
        @elseif (Session::has('alert-success'))
            <div class="alert alert-success alert-dismissable fade in" role="alert" align="center">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>{{ Session::get('alert-success') }}</strong>
            </div>
			@endif
		<div class="wrapper">
        <div id="Animate" style="margin-top:20vh">
        @yield('main') <!-- Blade command: include section from child file -->
		</div>
		<div class="push"></div>
		</div>
		<div class="footer">
		@include('layouts.copyright') <!-- Blade command: include other blade file -->
		</div>
    </body>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript" src="/js/common.js"></script>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    @yield('script')
</html>
