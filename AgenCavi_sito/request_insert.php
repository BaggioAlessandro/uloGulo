<?php
	include "/lib/funzioni_mysql.php";
	include "/lib/ac_mail.php";
	
	if(strcmp($_POST['nome'], "") && strcmp($_POST['societa'], "") && strcmp($_POST['email'], "")){
		$data = new MysqlClass();
		$data->connetti();
			
		
		//salvataggio nella tabella utente con pendenza
		
		$t = "utenti"; # nome della tabella

		$password = ac_randomPassword();
		
		$nome = $_POST['nome'];
		$azienda = $_POST['societa'];
		$email = $_POST['email'];
		
		if(isset($_POST['telefono'])){
		
			$telefono = $_POST['telefono'];
			$v = array ($nome,$password,$email,$azienda,$telefono,$email); # valori da inserire
			$r =  "nome,password,mail,azienda,telefono,user_name"; # campi da popolare
			
		}else{
			$v = array ($nome,$password,$email,$azienda,$user_name); # valori da inserire
			$r =  "nome,password,mail,azienda,user_name"; # campi da popolare
		}

		if(ac_mail_no-reply($email,"Password",$password)){
			$data->inserisci($t,$v,$r);
		}
		
		
		$data->disconnetti();
	}else{
		echo("manca qualcosa");
	}
	header("Location: index.php");
?>