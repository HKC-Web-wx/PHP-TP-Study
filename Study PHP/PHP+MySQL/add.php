<?php 
	function add_user(){

		if (empty($_FILES['avatar'])) {
			$GLOBALS['error_message'] = '请选取图片';
			return;
		}

		$ext = pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION);
		$target = '../upload' . uniqid() . '.' . $ext;

		if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $target)) {
			$GLOBALS['error_message'] = '上传头像失败';
			return;
		}
		$avatar = substr($target, 2);
		

		if(empty($_POST['name'])){
			$GLOBALS['error_message'] = '请输入姓名';
			return;
		}
		if(!(isset($_POST['gender']) && $_POST['gender'] !== '-1')){
			$GLOBALS['error_message'] = '请选择性别';
			return;
		}
		if(empty($_POST['birthday'])){
			$GLOBALS['error_message'] = '请选择日期';
			return;
		}

		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$birthday = $_POST['birthday'];

		

		//建立连接
		$connection = mysqli_connect('127.0.0.1','root','123456','demo3');
		if (mysqli_connect_errno($connection)) 
		{ 
    		echo "连接 MySQL 失败: " . mysqli_connect_error(); 
		}
		//添加
		$query = mysqli_query($connection,"insert into users values(null,'{$name}',{$gender},'{$birthday}','{$avatar}')");
		if(!$query){
			exit('<h1>添加失败</h1>');
		}
		//获取结果/跳转
		$affected_rows = mysqli_affected_rows($connection);
		if ($affected_rows !== 1) {
			$GLOBALS['error_message'] = '添加数据失败';
			return;
		}
		header('Location: list.php');
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		add_user();
	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div>
		<h1>添加新用户</h1>
		<div>
			<?php if (isset($error_message)): ?>
				<?php echo $error_message; ?>
			<?php endif ?>
		</div>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
			<div>
				<label for="avatar">头像</label>
				<input type="file" id="avatar" name="avatar" >
			</div>
			<div>
				<label for="name">姓名</label>
				<input type="text" id="name" name="name" >
			</div>
			<div>
				<label for="gender">性别</label>
				<select id="gender" name="gender">
					<option value="-1">请选择性别</option>
					<option value="1">男</option>
					<option value="0">女</option>
				</select>
			</div>
			<div>
				<label for="birthday">生日</label>
				<input type="date" name="birthday" id="birthday">
			</div>
			<button type="submit">保存</button>
		</form>
	</div>
</body>
</html>