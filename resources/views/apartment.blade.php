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
                <li><a href="sendPage" onclick="setTo('admin@mavs.uta.edu')">super user</a></li>
                <li><a href="apart_report">Reports</a></li>
                <li><a href="apart_message">Message</a></li>
                <li><a href="messageTest">Chat</a></li>
                <li><a hred="apartment" id="name"></a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="contact_txt">
    <h1 id="title_cu">Apartment Page</h1>
</div>
<div id="apart_info">
    
</div>
<div class="request_title">
    <h1 id="request_title">Send Request</h1>
</div>
<div class="contact_txt">
    <textarea id="textarea" class="request_text" type="text" name="msg"></textarea>
    <input class="request_button" type="button" value="Send" onclick="sendRequest()">
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
			url:'apart_getContact',
			success: function(data){
				document.getElementById("apart_info").innerHTML = data;
		}
	})
	}

    function sendRequest(){
        $.ajax({
            type:'get',
            url:'apart_sendRequest',
            data: {msg:$('#textarea').val()},
            success: function(data){
                $("#textarea").val("");
                alert('send request success');
            }
        })
    }
	
    function setTo(user){
        $.ajax({
            type:'get',
            url:'setTo',
            data: {to: user},
            success: function(data){
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