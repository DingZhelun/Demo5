<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="{{URL::asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/bootstrap-theme.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/login.css')}}" rel="stylesheet">
</head>
<body>
<script src="{{URL::asset('/js/login.js')}}" type="text/javascript"></script>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only " >Toggle navigation</span>login.blade.php
                <span class="icon-bar" ></span>
                <span class="icon-bar" ></span>
                <span class="icon-bar" ></span>
            </button>
            <a class="navbar-brand" href="#" >House Portal</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="whyus.html">Why us</a></li>
                <li><a href="contact_us.html">Contact us</a></li>
                <li><a href="http://zxd8813.uta.cloud">Blog</a></li>
                <li><a href="login">Login</a></li>
                <li><a href="signup">Sign Up</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container" role="main">
    <div class="jumbotron bg" style="height: 100%">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <form action="" class="form-horizontal" method="post" name="Login" onsubmit="InputCheck()">
                        <span class="heading">Login</span>
                        <div class="form-group">
                            <p>Email</p>
                            <input type="email" class="form-control" id="email" placeholder="email">
                        </div>
                        <div class="form-group">
                            <p>Password</p>
                            <input type="password" class="form-control" id="password" placeholder="password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>



</body>
</html>
