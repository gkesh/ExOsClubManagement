<?php
	if(isset($_GET['bgimg'])){
		if(file_exists("../files/background-loc.txt")){
			try{
				$bglocfile = fopen("../files/background-loc.txt","r+");
				@ftruncate($bglocfile, 0);
				fwrite($bglocfile,$_GET['bgimg']);
			}catch(Exception $e){
				die("Error:: ".$e->getMessage());
			}finally{
				fclose($bglocfile);
				header("Location:$_SERVER[HTTP_REFERER]",FALSE);
			}
		}
	}else{
		header("Location:$_SERVER[HTTP_REFERER]");
	}
?>