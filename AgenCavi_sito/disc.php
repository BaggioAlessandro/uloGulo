<?php
	session_start();
	session_unset();
	session_destroy(); 
	if(isset($_POST["go_to"])){
		header("Location: ".$_POST['go_to']."");
	}
	header("Location: index.php");
?>