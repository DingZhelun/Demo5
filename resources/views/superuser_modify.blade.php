<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subdivision</title>
    <link href="{{URL::asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/bootstrap-theme.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/contact_us.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/subdivision.css')}}" rel="stylesheet">
    <script src="/js/echarts.min.js"></script>
</head>
<body>
<script src="//cdn.bootcss.com/jquery/3.0.0-alpha1/jquery.min.js"></script>
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
                <li><a href="http://zxd8813.uta.cloud">Blog</a></li>
                <li><a href="login">Logout</a></li>
                <li><a href="subd_message">Message</a></li>
                <li><a href="messageTest">Chat</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="contact_txt">
    <h1 id="title_cu">Modify User</h1>
</div>

<div id="modify_info" class="modify_box">
    <p>email:</p><textarea id="email" readonly></textarea><br>
    <p>name:</p><textarea id="name"></textarea><br>
    <p>tel:</p><textarea id="tel"></textarea><br>
    <p>password:</p><textarea id="password"></textarea><br>
    <p>role:</p><textarea id="role"></textarea><br>
    <input class="request_button" type="button" value="modify" onclick="updateUser()">
</div>


<script>
    window.onload = getUser();
    window.onload = defaultInfo();

    function getUser(){
        $.ajax({
            type:'get',
            url:'getUser',
            dataType: 'json',
            success: function(data){
                if(data===0){
                    alert("please login!");
                    window.location.href="login.html";
                }
                else{
                    document.getElementById("name").innerHTML = data;
                }
            }
        })
    }

    function defaultInfo() {
        $.ajax({
            type:'get',
            url:'super_defaultInfo',
            dataType: "json",
            success: function(data){
				console.log(data);
                document.getElementById("email").innerHTML = data.contact_email;
                document.getElementById("name").innerHTML = data.contact_name;
                document.getElementById("tel").innerHTML = data.contact_tel;
                document.getElementById("password").innerHTML = data.password;
                document.getElementById("role").innerHTML = data.role;
            }
        })
    }

    function logout(){
        $.ajax({
            type:'get',
            url:'logout',
            success: function(data){
            }
        })
    }

    function updateUser() {
        $.ajax({
            type:'get',
            url:'super_updateUser',
            data: {email: $("#email").val(), name: $("#name").val(), tel:$("#tel").val(), password:$("#password").val(), role:$("#role").val()},
            success: function(data){
                alert('modify user success');
            }
        })
    }
</script>

</body>
</html>