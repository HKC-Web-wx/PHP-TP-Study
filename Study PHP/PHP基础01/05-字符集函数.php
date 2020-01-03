<?php 
	// strlen() 只能准确获取拉丁文字符长度
	echo strlen('你好');
	echo '<br>';

	echo mb_strlen('你好啊')
 ?>