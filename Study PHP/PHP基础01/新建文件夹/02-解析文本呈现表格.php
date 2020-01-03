<?php 
	header("content-Type: text/html; charset=Utf-8");
	// 1.读取文件内容
	$contents = file_get_contents('test.txt');

	// 2.按照特定的规则解析文件内容 "\n" 要用双引号
	$lines = explode("\n", $contents);	//拆分成行
	var_dump($lines);

	//2.2遍历每一行分别解析每一行中的数据
	$data = array();	//存解析好的每一行的数据
	foreach ($lines as $item) {	//item =>	'1 | 小明 | 21 | q.asdefs.sa | http://HEAS.com' 循环每一行
		if(!$item) continue;
		$cols = explode('|', $item);
		$data[] = $cols;
	}

	// 3.通过混编的方式将文本数据呈现到表格中
	var_dump($data);

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>人员信息表</title>
 </head>
 <body>
 	<table>
 		<thead>
 			<tr>
 				<th>编号</th>
 				<th>姓名</th>
 				<th>年龄</th>
 				<th>邮箱</th>
 				<th>网址</th>
 			</tr>
 		</thead>
 		<tbody>
 			<?php foreach ($data as $lines): ?>
 				<tr>
 					<?php foreach ($lines as $col): ?>
 						<?php $col = trim($col); ?>
 						<?php if (strpos($col ,'http://') === 0): ?>
 							<td><a href="<?php echo strtolower($col); ?>"><?php echo substr($col, 7); ?></a></td>
 						<?php else: ?>
 							<td><?php echo $col; ?></td>
 						<?php endif ?>
 					<?php endforeach ?>
 				</tr>
 			<?php endforeach ?>
 		</tbody>
 	</table>
 </body>
 </html>