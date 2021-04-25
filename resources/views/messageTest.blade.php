<?php
include_once 'php-db.php';
$result = $mysqli -> query('
	SELECT * FROM (
		SELECT name, message, time FROM realchats ORDER BY time DESC LIMIT 20
	) tmp ORDER BY time ASC
');
?>


<!DOCTYPE html>
<html>
<head>
	<title>Chat App In my WDM Class</title>
    <link href="{{URL::asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/bootstrap-theme.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/contact_us.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/subdivision.css')}}" rel="stylesheet">
<style type="text/css">
	* {
		box-sizing:border-box;
	}
	#content {
		width:600px;
		max-width:100%;
		margin:30px auto;
		background-color:#fafafa;
		padding:20px;
	}
	#message-box {
		min-height:400px;
		overflow:auto;
	}
	.author {
		margin-right:5px;
		font-weight:600;
	}
	.text-box {
		width:100%;
		border:1px solid #eee;
		padding:10px;
		margin-bottom:10px;
	}
</style>

</head>
<body>
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
                <li><a id="name"></a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="contact_txt">
    <h1 id="title_cu">Online Chat</h1>
</div>
<div id="content">
	<div id="message-box">
		<?php foreach ($result as $row) : ?>
			<div>
				<span class="author"><?= $row['name'] ?>:</span>
				<span class="messsage-text"><?= $row['message'] ?></span>
			</div>	
		<?php endforeach; ?>	
	</div>
	<div id="connecting">Connecting to web sockets server...</div>
	<input type="text" class="text-box" id="name-input" placeholder="Your Name">
	<input type="text" class="text-box" id="message-input" placeholder="Your Message" onkeyup="handleKeyUp(event)">
	<p>Press enter to send message</p>
</div>
<script type="text/javascript" src="/js/js-index.js"></script>
</body>
</html>
