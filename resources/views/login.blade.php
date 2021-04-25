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
<script type="application/javascript">
    function InputCheck(){
        if (email.value==""){
            alert("Please input email!")
            Login.email.focus();
            return(false);
        }
        if (password.value==""){
            alert("Please input password!")
            Login.password.focus();
            return(false);
        }
    }
</script>
<!--<script type="application/javascript">-->
<!--    var y = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;-->
<!--    $("[name='email']").blur(function (){-->
<!--        var v = $(this).val();-->
<!--        if (v==''){-->
<!--            $("[name='email']").next().html("email不能为空");-->
<!--            $(this).prev().css("color","#f00");-->
<!--        }else if (!v.match(y)){-->
<!--            $("[name='email']").next().html("email格式不对");-->
<!--            $("[name='email']").prev().css("color","#f00");-->
<!--        }else{-->
<!--            $(this).prev().css("color","#0EA74A");-->
<!--            $("[name='email']").next().html("");-->
<!--        }-->
<!--    })-->
<!--</script>-->
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
    <div class="jumbotron bg" style="height: 100%">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <form action="{{url('dologin')}}" class="form-horizontal" method="post" name="Login">
                        {{csrf_field()}}
                        <span class="heading">Login</span>
                        <div class="form-group">
                            <p>Email</p>
                            <input name="email" type="email" class="form-control" id="email" placeholder="email">
                        </div>
                        <div class="form-group">
                            <p>Password</p>
                            <input name="password" type="password" class="form-control" id="password" placeholder="password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>



</body>
</html>
