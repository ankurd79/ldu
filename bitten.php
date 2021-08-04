<?php
	
	//echo rand(0,100);

	function isBitten(){
		$str=rand(0,100);
		if($str>=50){
			return true;
		}else{
			return false;
		}
	}

	/****************/

	$var=isBitten();
	if($var==1){
		echo 'Charlie bit your finger!';	
	}else{
		echo 'Charlie didn\'t bit your finger!';
	}


?>