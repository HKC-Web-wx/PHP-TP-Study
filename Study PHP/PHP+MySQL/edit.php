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
	mysqli_set_charset($connection,'utf8');
	//查询
	$query = mysqli_query($connection,"select * from users where id = {$id} limit 1;");
	if(!$query){
		exit('<h1>查询失败</h1>');
	}
	//获取结果/跳转
	$user = mysqli_fetch_assoc($query);
	echo $user["name"];
	// header('Location: list.php');
	if(!$user){
		exit('<h1>找不到要编辑的数据</h1>');
	}

	function edit(){
		global $user;
		$id = $_GET['id'];
		echo '$id';

		echo "$id";
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

		$user["name"]= $_POST["name"];
		$user["gender"] = $_POST['gender'];
		$user["birthday"] = $_POST['birthday'];

		if(isset($_FILES['avatar'])&& $_FILES['avatar']['error'] === UPLOAD_ERR_OK){
			$ext = pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION);
			$target = '../upload' . uniqid() . '.' . $ext;
	
			if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $target)) {
				$GLOBALS['error_message'] = '上传头像失败';
				return;
			}
			$user['avatar'] = substr($target, 2);
		}

		// $user => 修改过后的信息
		
		//建立连接
		$connection = mysqli_connect('127.0.0.1','root','123456','demo3');
		if (mysqli_connect_errno($connection)) 
		{ 
   	 		echo "连接 MySQL 失败: " . mysqli_connect_error(); 
		}
		mysqli_set_charset($connection,'utf8');

		//查询
		//
		$query = mysqli_query($connection,"update users set name='".$user["name"]."',gender='".$user["gender"]."',birthday='".$user["birthday"]."',avatar='".$user["avatar"]."' where id ='$id'");
		if(!$query){
			exit('<h1>编辑失败</h1>');
		}
		header('Location: list.php');

	}

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		edit();
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
		<h1>编辑<?php echo $user['name'] ?></h1>
		<div>
			<?php if (isset($error_message)): ?>
				<?php echo $error_message; ?>
			<?php endif ?>
		</div>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $user['id']; ?>" method="post" enctype="multipart/form-data">
			<!-- <img src="<?php echo $users['avatar'] ?>"> -->
			<div>
				<label for="avatar">头像</label>
				<input type="file" id="avatar" name="avatar" >
			</div>
			<div>
				<label for="name">姓名</label>
				<input type="text" id="name" name="name" value="<?php echo $user['name'] ?>">
			</div>
			<div>
				<label for="gender">性别</label>
				<select id="gender" name="gender">
					<option value="-1">请选择性别</option>
					<option value="1"<?php echo $user['gender'] === '1' ? ' selected': '' ?>>男</option>
					<option value="0"<?php echo $user['gender'] === '0' ? ' selected': '' ?>>女</option>
				</select>
			</div>
			<div>
				<label for="birthday">生日</label>
				<input type="date" name="birthday" id="birthday" value="<?php echo $user['birthday'] ?>">
			</div>
			<button type="submit">保存</button>
		</form>
	</div>
</body>
</html>