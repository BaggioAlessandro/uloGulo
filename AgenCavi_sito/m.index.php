<!--
	
	PARAMETRI USATI:
	
	from: parametro passato con GET. serve a reindirizzare l'utente dopo il login nel caso in cui arrivi da QR_CODE
	
	user: nome utente passato in POST
	
	password: password passata in POST

-->

<?php

	include "/lib/funzioni_mysql.php";
	//la grafica di questa pagina è presa da quella del sito vecchio
	session_start();
	
	//se esiste una connessione vai alla pagina delle ricerche
	if(isset($_SESSION['login'])){
		header("Location: ricerca.php");
	}
	
	//salvataggio pagina di provenienza
	if(isset($_GET['from'])){
		$go_to = $_GET['from'];
	}else{
		$go_to = "ricerca.php";
	}
	
	if(isset($_POST['submit']) && trim($_POST['submit']=="Login")){
		echo($_POST["user"]);
		$user_name = $_POST["user"];
		$password = trim($_POST["password"], FILTER_SANITIZE_STRING);
		
		 
		$data = new MysqlClass();

		if($data->connetti()){
			$aut = $data->query("SELECT user_name,password FROM utenti WHERE user_name='$user_name'");
			
			if(mysql_num_rows($aut) == 0 ){
				echo "$user_name";
				echo("nome utente inesistente");
			
			}else{
				$ris = $data->estrai($aut);
				if(strcmp($ris->password,$password)==0){
					$_SESSION["login"] = $ris->user_name;
					header("Location: ".$go_to);
				
				}else{
					echo "password errata";
				}
				
				$data->disconnetti();
				
				
			}
		}else{
			echo("errore di connessione");
		}
		
	}
?>
<?php
	include "/lib/ac_mobile.php";
	ac_header("index.php");
?>
	<div id="ac-container">
		<div class="ac-content-box">
<!-- -.-.-.-.-.-.-.-.-.-.-.-.-.-.- SCRIVI LA TUA ROBA QUI' -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- -->
		
				<h1> Login </h1>
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
					Nome Utente<br />
					<input type="text" style="width:250px;" name="user"/><br /><br />
					Password<br />
					<input type="password" style="width:250px;" name="password"/><br /><br />
					<input type="submit" name="submit" value="Login" />
				</form>
				Non sei registrato ?
<?php
	
?>
				<h1> Registrati </h1>
				<p>Invia una richiesta di registrazione, un'e-mail ti notificher&agrave; l'inoltro della richiesta, nel giro di qualche giorno una seconda e-mail ti comunicher&agrave; i tuoi dati di accesso.</p>
				<p class="ac-important">Compila tutti i campi</p>
				<form style="text-align: left;" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<table style="padding:20px;">
						<tr><td>
						Nome:</td><td> <input type="text" style="width:250px;" name="nome"/></td></tr>
						<tr><td>
						Societ&agrave;:</td><td> <input type="text" style="width:250px;" name="societa"/></td></tr>
						<tr><td>
						e-mail:</td><td> <input type="text" style="width:250px;" name="email"/></td></tr>
						<tr><td>
						Telefono:</td><td> <input type="text" style="width:250px;" name="telefono"/></td></tr>
						<tr><td colspan=2>
						<input type="submit" name="submit" value="Invia Richiesta" />
						</td></tr>
					</table>
				</form>
		</div>
	</div>
<?php
	ac_footer();
?>
<!-- -.-.-.-.-.-.-.-.-.-.-.-.-.-.- STOP -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- -->