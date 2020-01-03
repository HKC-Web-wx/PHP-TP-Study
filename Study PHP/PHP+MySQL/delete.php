<?php 
	//接收删除键的id
	if(empty($_GET['id'])){
		exit('<h1>必须传入指定参数</h1>');
	}
	$id = $_GET['id'];
	//建立连接
	$connection = mysqli_connect('127.0.0.1','root','123456','demo3');
	if (mysqli_connect_errno($connection)) 
	{ 
    	echo "连接 MySQL 失败: " . mysqli_connect_error(); 
	}
	//删除
	$query = mysqli_query($connection,'delete from users where id = ' . $id . ';');
	if(!$query){
		exit('<h1>查询失败</h1>');
	}
	//获取结果/跳转
	$affected_rows = mysqli_affected_rows($connection);
	if ($affected_rows <= 0) {
		exit('<h1>删除操作失败</h1>');
	}
	header('Location: list.php');

 ?>