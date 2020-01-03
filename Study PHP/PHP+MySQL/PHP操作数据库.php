<?php 
	
	header("Content-Type: text/html; charset=UTF-8"); //设置字符的编码是utf-8

	// mysql_query('SET NAMES UTF-8');

	// 建立与数据库的连接
	$connection = mysqli_connect('127.0.0.1','root','123456','demo3');

	if (!$connection) {
		exit('连接失败');
	}
	//设置编码格式
	mysqli_set_charset($connection,"utf8");

	//查询
	$query = mysqli_query($connection, 'select name from users;');

	//遍历结果集
	while ($row = mysqli_fetch_assoc($query)) {
		var_dump($row);
	}
	//释放结果集
	mysqli_free_result($query);
	//关闭连接
	mysqli_close($connection);