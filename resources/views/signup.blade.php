<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link href="{{URL::asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/bootstrap-theme.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/login.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/signup.css')}}" rel="stylesheet">
</head>
<body>
<script src="//cdn.bootcss.com/jquery/3.0.0-alpha1/jquery.min.js"></script>
<script src="{{URL::asset('/js/signup.js')}}" type="application/javascript"></script>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only " >Toggle navigation</span>
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
                    <form class="form-horizontal" method="post" name="SignUp" onsubmit="return InputCheck()">
                        {{csrf_field()}}
                        <span class="heading">Sign Up</span>
                        <div class="form-group">
                            <p>Email</p>
                            <input name="email" type="email" class="form-control" id="email" placeholder="email">
                        </div>
                        <div class="form-group">
                            <p>Password</p>
                            <input name="password" type="password" class="form-control" id="password" placeholder="password">
                        </div>
                        <div class="form-group">
                            <p>Name</p>
                            <input name="name" type="text" class="form-control" id="name" placeholder="name">
                        </div>
                        <div class="form-group">
                            <p>Phone</p>
                            <input name="phone" type="text" class="form-control" id="phone" placeholder="phone">
                        </div>
                        <div class="form-group">
                            <p>Address</p>
                            <input name="address" type="text" class="form-control" id="address" placeholder="address">
                        </div>
                        <div class="form-group">
                            <p>Your Preference</p>
                            <select class="form-control" name="role" id="role" onclick="selectRole()">
                                <option value="Subdivision">Subdivision</option>
                                <option value="Building">Building</option>
                                <option value="Apartment">Apartment</option>
                            </select>
                        </div>
                        <div class="form-group" id="subdivision_text">
                            <p>Subdivision</p>
                            <input name="subdivision" type="text" class="form-control" id="subdivision" placeholder="subdivision">
                        </div>
                        <div class="form-group" id="building_text">
                            <p>Building</p>
                            <select name="building" class="form-control"  id="building">
                                <option value="none" hidden>--select--</option>
                            </select>
                        </div>
                        <div class="form-group" id="apartment_text">
                            <p>Apartment</p>
                            <select name="apartment" class="form-control"  id="apartment">
                                <option value="none" hidden>--select--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <p>What do you want Sign up for</p>
                            <select class="form-control" name="service" id="service" onclick="selectService()">
                                <option value="select" hidden>--select--</option>
                                <option value="Service">Service</option>
                                <option value="Self-Service">Self-Service[Apt]</option>
                            </select>
                        </div>
                        <div id="service_div">
                            <label><input class="form-inline" id = "water" name="water" type="checkbox" value="water ">water</label>
                            <label><input class="form-inline" id = "gas" name="gas" type="checkbox" value="gas ">gas</label>
                            <label><input class="form-inline" id = "electricity" name="electricity" type="checkbox" value="electricity ">electricity</label>
                            <label><input class="form-inline" id = "Internet" name="Internet" type="checkbox" value="Internet ">Internet</label>
                        </div>
                        <br>
                        <div class="form-group row">
                            <p>Verification Code</p>
                            <input style="width: 70%" name="code" class="form-control col-lg-1" type="text" id="verification_code" placeholder="verification code">
                            <input style="width: 30%" class="btn btn-info col-lg-2" id="send_code" type="button" value="Send Code" onclick="return InputCheck()">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" id="submit" type="button" name="submit" value="Sign Up" onclick="return InputCheck()">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
</body>
</html>
