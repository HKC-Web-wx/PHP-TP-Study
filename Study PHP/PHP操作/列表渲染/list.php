<?php 
	$json = file_get_contents('data.json');
	
	$data = json_decode($json,true);
	var_dump($data);

	if(!$data){
		//JSON格式不正确
		exit('数据文件异常');
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>列表</title>
	<style type="text/css">
		table{
			border:1px solid #333;
		}
	</style>
</head>
<body>
	<div>
		<div><a href="add.php">添加</a></div>
		<table>
			<thead>
				<tr>
					<th>标题</th>
					<th>歌手</th>
					<th>海报</th>
					<th>音乐</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $item): ?>
					<tr>
						<td><?php echo $item['title'] ?></td>
						<td><?php echo $item['artist'] ?></td>
						<td>
							<?php foreach ($item['images'] as $src): ?>
								<img src="<?php echo $src; ?>" alt="">
							<?php endforeach ?>
						</td>
						<td><audio src="<?php echo $item['source']; ?>"></audio></td>
						<td><button><a href="delete.php?id=<?php echo $item['id'] ?>">删除</a></button></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>
</html>