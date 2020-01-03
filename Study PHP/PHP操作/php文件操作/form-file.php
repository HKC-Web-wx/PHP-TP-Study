<?php 

	function upload(){
		if(!isset($_FILES['avatar'])){
			$GLOBALS['message']= '请选择文件!!';
			//客户端提交的表单内容 没有文件域
			return;
		}
		$avatar = $_FILES['avatar'];

		if($avatar['error'] !=== UPLOAD_ERR_OK){
			//服务端没有接收到上传的文件
			//error=0 代表可以
			$GLOBALS['message'] = '上传失败!';
			return;
		}

		// 将文件从临时目录移动到网站范围之内
		$source = $avatar['tmp_name'];	//源文件在哪
		$target = './uploads/' . $avatar['name'];	//文件放在哪
		//移动的目标路径中 文件夹一定是
		$moved = move_uploaded_file($source, $target);

		if(!$moved){
			$GLOBALS['message'] = '上传失败'；
			return;
		}
	}


	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		upload();
	}


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<!-- 如果一个表单中有文件域（文件上传） enctype设置为 enctype='multipart/form-data' -->
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method='post' enctype='multipart/form-data'>
		<input type="file" name="avatar">
		<button type="">提交</button>
		<?php if(isset($message)): ?>
			<p><?php echo $message; ?></p>
		<?php endif ?>
	</form>
</body>
</html>