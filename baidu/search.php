<?php
        mysql_connect('localhost:3306','root','yourpasswd');
        mysql_set_charset('utf8');
        mysql_select_db('weixin');

        $openid = $_GET['openid'];
        $key = $_GET['key'];

        $sql = "select latitude,longitude from location where openid = '$openid' order by id desc limit 1";
        $res = mysql_query($sql);
        $row = mysql_fetch_assoc($res);
        $longitude = $row[longitude];
        $latitude  = $row[latitude];

        $apikey = "yourApiKey";

?>


<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css">
		body, html {width: 100%;height: 100%;margin:0;font-family:"微软雅黑";}
		#allmap{width:100%;height:500px;}
		p{margin-left:5px; font-size:14px;}
	</style>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo $apikey?>"></script>
	<title><?php echo $key?></title>
</head>
<body>
	<div id="allmap"></div>
	<p>返回北京市“景点”关键字的检索结果，并展示在地图上</p>
</body>
</html>
<script type="text/javascript">
	// 百度地图API功能
	var map = new BMap.Map("allmap");          
	map.centerAndZoom(new BMap.Point(<?php echo "$longitude,$latitude"?>), 11);
	var local = new BMap.LocalSearch(map, {
		renderOptions:{map: map}
	});
	local.search("<?php echo $key?>");
</script>

