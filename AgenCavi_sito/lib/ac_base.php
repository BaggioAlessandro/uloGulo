<?php

	/*!
	*
	*
	*
	*/
	function ac_header(){
		$meta = "\t<meta charset=\"UTF-8\" />\n\t<meta http-equiv=\"Content-Language\" content=\"it-IT\" />\n";
		$title = "\t<title>CableCheck</title>\n";
		$js  = "\t\n";
		$css = "\t<link href = \"css/stile.css\" rel = \"stylesheet\" type = \"text/css\" >\n";
		
		$head = "<!DOCTYPE html>\n<html lang=\"it-IT\">\n<head>\n".$meta.$title.$js.$css."</head>\n";
		
		echo $head;
	}

?>