<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link href="{{URL::asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/bootstrap-theme.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/contact_us.css')}}" rel="stylesheet">
</head>
<body>
<!-- logo -->
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
                <li><a href="whyus">Why us</a></li>
                <li><a href="contact_us">Contact us</a></li>
                <li><a href="http://zxd8813.uta.cloud">Blog</a></li>
                <li><a href="login">Login</a></li>
                <li><a href="signup">Sign Up</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container" role="main">
        <div class="contact_txt">
            <h1 id="title_cu">Contact Us</h1>
        </div>
        <div class="map-wrap">
            <div class="map-l">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3356.3473487333276!2d-97.11948628423455!3d32.72996624368898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864e7d6dabc9564d%3A0x6c5cbeb084c8b76a!2z5b635bee5aSn5a2m6Zi_54G16aG_5YiG5qCh!5e0!3m2!1szh-CN!2shk!4v1614151564106!5m2!1szh-CN!2shk" width="700" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="map-r">
                <p class="title-item">UTA Housing</p>
                <p class="title-item">Address</p>
                <p class="content">701 S Nedderman Dr, Arlington, TX 76019</p>
                <p class="title-item">Phone</p>
                <p class="content">+1 817-272-2011</p>
                <p class="title-item">Email</p>
                <p class="content">housing@uta.edu.cn</p>
            </div>
        </div>
</div>


</body>
</html>
