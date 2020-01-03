<?php 

	//设置响应头中的set-cookie (给客户端)
	//在客户端存储的是键值结构
	// header('Set-Cookie: foo=bar');

	// setcookie() 用于设置cookie
	setcookie('key','value');


//只传递一个参数是删除
// setcookie('foo');
//传递两个参数是设置cookie
setcookie('key1','value2');
setcookie('key2','value22',time()+10);

