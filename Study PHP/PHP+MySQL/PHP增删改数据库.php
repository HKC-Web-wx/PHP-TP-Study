<?php 
	
	header("content-Type: text/html; charset=Utf-8");
	//连接
	$connection = mysqli_connect('127.0.0.1','root','123456','demo3');
	if (!$connection) {
		exit('连接失败');
	}
	//删除
	$query = mysqli_query($connection, 'delete from users where id = 9');
	
	if(!$query){
		exit('<h1>查询失败</h1>');
	}

	//拿取受影响行 方法传入的是连接对象
	$rows = mysqli_affected_rows($connection);

	var_dump($rows);
	
	
	mysqli_close($connection);