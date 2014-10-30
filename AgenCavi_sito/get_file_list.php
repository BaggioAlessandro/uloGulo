<?php
	
	$list = scandir("prod", 1);
	
	echo "name,date \n";
	foreach($list as $file){
		echo ''.$file.',';
		echo (date ("d m Y H:i:s.", filemtime("prod/".$file)) );
		echo "\n";
	}

	

?>