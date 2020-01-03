<?php 

	//数组遍历
	////for
	$arr = array("zhangsan","lisi","wangwu");
	for($i=0;$i<count($arr);$i++){
		$temp = $arr[$i];
		echo $temp . "<br/>";
	}

	//数组下标更改后 用foreach遍历
	$arr1 = array("name1" => "zhangsan","name2" => "lisi","name3" => "wangwu");
	foreach ($arr1 as $key => $value) {
		echo $key . ">>>" . $value . "<br/>";
	}
 ?>