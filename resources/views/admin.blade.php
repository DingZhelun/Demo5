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
            <a class="navbar-brand" href="homepage" >House Portal</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="http://zxd8813.uta.cloud">Blog</a></li>
                <li><a href="login">Logout</a></li>
                <li><a href="admin_message">Message</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="contact_txt">
    <h1 id="title_cu">Super User</h1>
</div>

<div id="apart_info">
  
</div>

<script>
    window.onload = getUser();
    window.onload = getContact();

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

    function getContact(){
        $.ajax({
            type:'get',
            url:'super_getInfo',
            success: function(data){
                document.getElementById("apart_info").innerHTML = data;
            }
        })
    }

    function modifyUser(user_email) {
        $.ajax({
            type:'get',
            url:'super_setModify',
            data: {user: user_email},
            success: function(data){
                console.log(data);
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

    function deleteUser(user_email) {
        $.ajax({
            type:'get',
            url:'super_deleteUser',
            data: {user: user_email},
            success: function(data){
                alert('delete user success');
                getContact();
            }
        })
    }
    
</script>

</body>
</html>