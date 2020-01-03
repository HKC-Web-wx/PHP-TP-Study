<?php 
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		var_dump($_POST);
	}


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		性别:<label><input type="radio" name="sex" value="男">男</label>
			<label><input type="radio" name="sex" value="女">女</label>
			<input type="file" name="img">
		<button type="submit">提交</button>
	</form>
</body>
</html>