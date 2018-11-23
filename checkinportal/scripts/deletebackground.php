<?php
	if(isset($_GET['bgimg'])){
		try{
			unlink($_GET['bgimg']);
		}catch(Exception $e){
			die("Error:: ".$e->getMessage());
		}finally{
			header("Location:../index.php#popup1");
		}
	}else{
		header("Location:$_SERVER[HTTP_REFERER]",FALSE);
	}
?>