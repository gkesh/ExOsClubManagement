<?php 

	$str="Here I go Sir    :";
	$match=array();
	ereg("[A-Z](.*)?(\s)?:",$str,$match);
	var_dump($match);
?> 