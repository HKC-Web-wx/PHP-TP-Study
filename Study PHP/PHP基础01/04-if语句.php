<!-- <?php 
	
	if(true){
		echo "hello";
	}

	if (false) :
		echo "hello";
	else :
		echo "Go";
	endif;

 ?> -->

 <?php 
 	$top = 'top12334';

 	function f1(){
 		global $top;

 		$sub = 'sub123';
 		echo $top . $sub;

 	}

 	f1();
  ?>

