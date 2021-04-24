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
                <li><a href="#">super user</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="contact_txt">
    <h1 id="title_cu">Message Page</h1>
</div>


<div id="apart_info">
    
</div>

<div class="contact_txt">
    <textarea id="to" class="message_to" type="text" name="to" placeholder="To: xxx@xx.com"></textarea>
    <textarea id="msg" class="request_text" type="text" name="msg"></textarea>
    <input class="request_button" type="button" value="Send" onclick="sendMessage()">
</div>


<script>
    // window.onload = getUser();
    window.onload = getTo();

    function getTo(){
        $.ajax({
            type:'get',
            url:'getTo',
            dataType: 'json',
            success: function(data){
                console.log(data)
                document.getElementById("to").innerHTML = data;
            }
        })
    }
    function sendMessage(){
        $.ajax({
            type:'get',
            url:'sendMessage',
            data: {to:$('#to').val(), msg:$('#msg').val()},
            success: function(data){
                $("#to").val("");
                $("#msg").val("");
                alert('send message success');
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
</script>
</body>
</html>