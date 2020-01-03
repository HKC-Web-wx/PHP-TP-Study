<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		
		.clearfix:after {
			content:"";
			display:block;
			height:0;
			clear:both;
			visibility:hidden;
		}
		.clearfix {
			*zoom:1;
			padding: 0;
			margin:0;
		}
		.box{
			width: 1000px;
			height: 100%;
			margin:0 auto;
		}
		.header{
			width: 100%;
		}
		ul li{
			float: left;
			width: 25%;
			height: 50px;
			line-height: 50px;
			box-sizing: border-box;
			border: 1px solid #ddd;
			background-color: green;
			list-style: none;
			text-align: center;
			font-size: 20px;
		}
		.banner{
			position: relative;
		}
		.banner img{
			width: 100%;
			height: auto;
			display: block;
			position: relative;
			top: 0;
			left: 0;
		}
		.banner a{
			position: absolute;;
			top: 0;
			right: 0;
		}
		.main{
			height: 500px;
			width: 100%;
			background-color: pink;
			line-height: 500px;
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="box">
		<div class="header">
			<ul class="clearfix">
				<li>首页</li>
				<li>第二页</li>
				<li>第三页</li>
				<li>第四页</li>
			</ul>
		</div>
		<?php if (empty($_COOKIE['close_banner']) || $_COOKIE['close_banner'] !== '1'): ?>
			<div class="banner">
				<img src="banner.jpg">
				<a href="close_banner.php">不再显示</a>
			</div>
		<?php endif ?>
		<div class="main">
			主体内容
		</div>
	</div>
</body>
</html>