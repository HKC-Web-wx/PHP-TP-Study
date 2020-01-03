<?php 
	function add(){
		$data = array();
		$data['id'] = uniqid();
		if(empty($_POST['title'])){
			$GLOBALS['error_message'] = '请输入标题';
			return;
		}
		if(empty($_POST['artist'])){
			$GLOBALS['error_message'] = '请输入歌手名字';
			return;
		}
		$data['title'] = $_POST['title'];
		$data['artist'] = $_POST['artist'];

		if (empty($_FILES['images'])) {
			$GLOBALS['error_message'] = '请选取图片';
			return;
		}
		$images = $_FILES['images'];
		$data['images'] = array();
		//遍历这个文件域中的每一个文件（判断是否成功，判断类型，判断大小，移动到网站目录中）
		for ($i=0; $i < count($images['name']); $i++) { 
			if ($images['error'][$i] !== UPLOAD_ERR_OK) {
				$GLOBALS['error_message'] = '上传图片失败1';
				return;
			}
			//文件类型校验
			if (strpos($images['type'][$i], 'image/') !== 0) {
				$GLOBALS['error_message'] = '上传图片文件格式错误';
				return;
			}
			//文件大小判断
			if ($images['size'][$i] > 1*1024*1024) {
				$GLOBALS['error_message'] = '上传图片文件过大';
				return;
			}
			
			//移动文件到网站范围内
			$dest = './uploads/' . uniqid() . $images['name'][$i];
			if (!move_uploaded_file($images['tmp_name'][$i], $dest)) {
				$GLOBALS['error_message'] = '上传图片失败2';
				return;
			}
			$data['images'][] = substr($dest, 2);
		}


		// 3.接收音乐文件
		if (empty($_FILES['source'])) {
			$GLOBALS['error_message'] = '请选择音乐文件';
			return;
		}
		$source = $_FILES['source'];
		//3.1 判断是否上传成功
		//3.2 判断类型是否正确
		//3.3 判断文件大小
		//3.4 移动文件到网站范围内
		//3.5 将数据装起来
		//
		//3.1
		if ($source['error'] !== UPLOAD_ERR_OK) {
			$GLOBALS['error_message'] = '上传音乐文件失败';
			return;
		}
		//3.2
		$source_allowed_types = array('audio/mp3','audio/wma');
		if (!in_array($source['type'], $source_allowed_types)) {
			$GLOBALS['error_message'] = '上传音乐文件类型错误';
			return;
		}
		//3.3
		if ($source['size'] < 1*1024*1024) {
			$GLOBALS['error_message'] = '上传音乐文件过小';
			return;
		}
		if ($source['size'] > 10*1024*1024) {
			$GLOBALS['error_message'] = '上传音乐文件过大';
			return;
		}
		//3.4
		$target = './uploads/' . uniqid() . '-' . $source['name'];
		if (!move_uploaded_file($source['tmp_name'], $target)) {
			$GLOBALS['error_message'] = '上传音乐失败2';
			return;
		}
		//3.5
		//保存数据的路径一定使用绝对路径
		$data['source'] = $target;

		// 4.将数据加入到原有数据中
		$json = file_get_contents('data.json');
		$old = json_decode($json,true);
		array_push($old, $data);
		$new_json = json_encode($old);
		file_put_contents('data.json', $new_json);

		//5.跳转
		header('Location: list.php');
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		add();
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加</title>
</head>
<body>
	<div>
		<h1>添加新音乐</h1>
		<div>
			<?php if (isset($error_message)): ?>
				<?php echo $error_message; ?>
			<?php endif ?>
		</div>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
			<div>
				<label for="title">标题</label>
				<input type="text" id="title" name="title" >
			</div>
			<div>
				<label for="artist">歌手</label>
				<input type="text" id="artist" name="artist" >
			</div>
			<div>
				<label for="images">海报</label>
				<input type="file" id="images" name="images[]" accept="image/*" multiple>
			</div>
			<div>
				<label for="source">音乐</label>
				<input type="file" id="source" name="source" accept=".mp3">
			</div>
			<button type="submit">保存</button>
		</form>
	</div>
</body>
</html>