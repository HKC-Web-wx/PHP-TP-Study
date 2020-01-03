<?php 
	
	$arr = array();
	$arr[0] = "11111";
	$arr[1] = "22222";
	$arr[2] = "33333";

	//echo $arr;//不能输出复杂类型
	echo $arr[0];
	echo "<br/>";
	print_r($arr);
	echo "<br/>";
	var_dump($arr);
	echo "<br/>";
	echo json_encode($arr);//将数组转换为json格式输出

	//数组下标索引自定义
	$arr2 = array("name1"=>"zhangsan","name2"=>"lisi","name3"=>"wangwu");
	
	var_dump($arr2);
	echo "<br/>";
	echo json_encode($arr2);

	//二维数组
	$arr3 = array();
	$arr3["zhangsan"]=array("age"=>19,"sex"=>"man","height"=>"180cm");
	$arr3["lsi"]=array("age"=>17,"sex"=>"woman","height"=>"170cm");
	$arr3["wangwu"]=array("age"=>16,"sex"=>"man","height"=>"177cm");

	var_dump($arr3);
	$resule = json_encode($arr3);
	echo $resule;
 ?>