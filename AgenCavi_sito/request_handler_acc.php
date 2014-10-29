<?php
	include "/lib/funzioni_mysql.php";
	include "/lib/redirect.php";
	session_start();
	$data = new MysqlClass();
	
	if($data->connetti()){
		$aut = $data->query("SELECT user_name FROM ac_admin WHERE user_name= '".$_SESSION['admin_login']."'");
	
		if(!isset($_SESSION["admin_login"])){
			header("Location: admin.php");
			die();
		}elseif(mysql_num_rows($aut) == 0 ){
			redirect_post("disc.php", array("go_to" => "admin.php"));
			header("Location: disc.php");
		}
		
		if(!isset($_POST['user'])){
			header("Location: admin-control3.php");
		}else{
			
			$user_name = $_POST['user'];
			$data->query("UPDATE utenti SET stato='C' WHERE user_name = '".$user_name."'");
			redirect_post("admin-control.php#request", array("from" => "handler"));
		}
	}else{
		echo "Errore di connessione";
	}


?>