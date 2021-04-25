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
                <li><a href="subd_report">Reports</a></li>
                <li><a href="subd_message">Message</a></li>
                <li><a hred="subdivision" id="name"></a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="contact_txt">
    <h1 id="title_cu">Subdivision Page</h1>
</div>
<div id="subd_info">

</div>
<div id="graph" class="graph">

</div>

<script>
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

    function getBuilding(){
        $.ajax({
            type:'get',
            url:'subd_getBuilding',
            // dateType: "json",
            success: function(data){
                document.getElementById("subd_info").innerHTML = data;
            }
        })
    }

    function getGraph(){
        $.ajax({
            type:'get',
            url:'subd_getGraph',
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
    function logout(){
        $.ajax({
            type:'get',
            url:'logout',
            success: function(data){  
            }
        })
    }

    function getUser(){
        $.ajax({
            type:'get',
            url:'getUser',
            dataType: 'json',
            success: function(data){
                console.log(data)
                document.getElementById("name").innerHTML = data;
                
            }
        })
    }
    // import * as echarts from 'echarts';
    // document.getElementById("name").innerHTML = name;
    var building,ele,gas,water;
    window.onload = getUser();
    window.onload = getBuilding();
    window.onload = getGraph();
    
    // graph settings
    var chartDom = document.getElementById('graph');
    var myChart = echarts.init(chartDom);
    var option;
    console.log(building);
    option = {
    title: {
        text: 'Building Usage Graph',
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