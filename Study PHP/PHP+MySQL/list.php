<?php 
	$connection = mysqli_connect('127.0.0.1','root','123456','demo3');
	if (mysqli_connect_errno($connection)) 
	{ 
    	echo "连接 MySQL 失败: " . mysqli_connect_error(); 
	}

	mysqli_set_charset($connection,'utf8');
	$query = mysqli_query($connection,'select * from users;');
	if(!$query){
		exit('<h1>查询失败</h1>');
	}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		
	</style>
</head>
<body>
	<h1><a href="add.php">添加数据</a></h1>
	<?php if (isset($error_message)): ?>
		<div>
			<?php echo $error_message ?>
		</div>
	<?php endif ?>
	<table>
		<thead>
			<tr>
				<th scope="col">编号</th>
				<th scope="col">头像</th>
				<th scope="col">名称</th>
				<th scope="col">性别</th>
				<th scope="col">年龄</th>
				<th scope="col">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($item = mysqli_fetch_assoc($query)): ?>
				<tr>
					<th><?php echo $item['id'] ?></th>
					<td><img src="<?php echo $item['avatar'] ?>"></td>
					<td><?php echo $item['name'] ?></td>
					<td><?php echo $item['gender'] == 0 ? '♀' : '♂' ?></td>
					<td><?php echo $item['birthday'] ?></td>
					<td>
						<button><a href="edit.php?id=<?php echo $item['id'] ?>">编辑</a></button>
						<button><<a href="delete.php?id=<?php echo $item['id'] ?>">删除</a></button>
					</td>
				</tr>
			<?php endwhile ?>
		</tbody>
	</table>
</body>
</html>