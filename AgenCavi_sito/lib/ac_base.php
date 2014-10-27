<?php

	/*!
	*
	*
	*
	*/
	function ac_header(){
		$meta = "\t<meta charset=\"UTF-8\" />\n\t<meta http-equiv=\"Content-Language\" content=\"it-IT\" />\n";
		$title = "\t<title>CableCheck</title>\n";
		$js  = "\t<script src=\"js/jquery-1.11.0.min.js\"></script>\n";
		$css = "\t<link href = \"css/style.css\" rel = \"stylesheet\" type = \"text/css\" >\n";
		
		$head = "<!DOCTYPE html>\n<html lang=\"it-IT\">\n<head>\n".$meta.$title.$js.$css."</head>\n";
		
		echo $head;
	}

?>