<?php

	/*!
	*
	*
	*
	*/
	function ac_header($redirect){
		$meta = "\t<meta charset=\"UTF-8\" />\n\t<meta http-equiv=\"Content-Language\" content=\"it-IT\" />\n";
		$title = "\t<title>CableCheck</title>\n";
		$js  = "\t<script src=\"js/jquery-1.11.0.min.js\"></script>\n";
		$mobile = "";//"<script type=\"text/javascript\"> if(/Android|WebOS|iPhone|iPad|iPod|BlackBerry|IEMobile|OperaMini/i.test(navigator.userAgent)){window.location.replace(\"".$redirect."\")}</script>\n";
		$css = "\t<link href = \"css/mstyle.css\" rel = \"stylesheet\" type = \"text/css\" >\n";
		
		$head = "<!DOCTYPE html>\n<html lang=\"it-IT\">\n<head>\n".$meta.$title.$js.$mobile.$css."</head>\n";
		
		echo $head;
		echo "<body>\n";
	}
	
	/*!
	*
	*
	*
	*/
	function ac_footer(){
		$footer = "";
		$script = "";
		
		echo "</body>\n</html>";
	}
	
	function ac_initLPanel($title){
		
	}
	
	function ac_finalizeLPanel(){
		
	}

?>