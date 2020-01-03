<?php 
	
	//通过客户端在URl地址中的问号参数的不同来辨别要删除的数据
	echo $_GET['id'];
	//接收URL中的不同的ID
	if (empty($_GET['id'])) {

		exit('<h1>必须指定参数</h1>');
	}
	$id = $_GET['id'];

	//找到要删除的数据 
	$data = json_decode(file_get_contents('data.json'),true);
	foreach ($data as $item) {
		if ($item['id'] !== $id) continue;
		//从原有数据中移除
		$index = array_search($item, $data);
		array_splice($data, $index, 1);
		//保存删除指定数据后的内容
		$json = json_encode($data);
		file_put_contents('data.json', $json);
		//跳转
		header('Location: list.php');
	}
	
	
 ?>