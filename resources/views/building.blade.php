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
                <li><a href="sendPage" onclick="setTo('admin@mavs.uta.edu')">super user</a></li>
                <li><a href="build_report">Reports</a></li>
                <li><a href="build_message">Message</a></li>
                <li><a hred="building" id="name"></a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="contact_txt">
    <h1 id="title_cu">Building Page</h1>
</div>
<div id="build_info">
    
</div>
<div id="graph" class="graph">

</div>

<script>
    var building,ele,gas,water;
    window.onload = getGraph();
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
            url:'build_getContact',
            success: function(data){
                document.getElementById("build_info").innerHTML = data;
            }
        })
    }
    
    function setTo(user){
        $.ajax({
            type:'get',
            url:'setTo',
            data: {to: user},
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
    function getGraph(){
        $.ajax({
            type:'get',
            url:'build_getGraph',
            async: false,
            success: function(data){
                var result = JSON.parse(data);
                console.log(result);
                building=result[0];
                ele=result[1];
                gas=result[2];
                water=result[3];
            }
        })
    }

    var chartDom = document.getElementById('graph');
    var myChart = echarts.init(chartDom);
    var option;
    console.log(building);
    option = {
    title: {
        text: 'Apartment Usage Graph',
        subtext: ''
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data: ['electricity', 'water','gas']
    },
    toolbox: {
        show: true,
        feature: {
            dataView: {show: true, readOnly: true},
            magicType: {show: false, type: ['line', 'bar']},
            restore: {show: false},
            saveAsImage: {show: false}
        }
    },
    calculable: true,
    xAxis: [
        {
            type: 'category',
            data: building,//building
        }
    ],
    yAxis: [
        {
            type: 'value'
        }
    ],
    series: [
        {
            name: 'electricity',
            type: 'bar',
            data: ele,
        
        },
        {
            name: 'gas',
            type: 'bar',
            data: gas,
            
        },
        {
            name: 'water',
            type: 'bar',
            data: water,
        }
    ]
}   

option && myChart.setOption(option);
</script>
</body>
</html>