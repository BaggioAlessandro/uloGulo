<!--
	
	PARAMETRI USATI:
	
	from: parametro passato con GET. serve a reindirizzare l'utente dopo il login nel caso in cui arrivi da QR_CODE
	
	user: nome utente passato in POST
	
	password: password passata in POST

-->

<?php
	$MAX_SEARCH = 5;
	
	include "/lib/funzioni_mysql.php";
	//la grafica di questa pagina è presa da quella del sito vecchio
	session_start();
	
	//se esiste una connessione vai alla pagina delle ricerche
	if(isset($_SESSION['login'])){
		header("Location: ricerca.php");
	}
	
	//salvataggio pagina di provenienza
	if(isset($_POST['from'])){
		$go_to = $_POST['from'];
	}else{
		$go_to = "ricerca.php";
	}
	
	if(isset($_POST['submit']) && trim($_POST['submit']=="Login")){
		str_replace($_POST["user"], '@', '\@');
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
				if(strcmp($ris->password,$password)==0 && $ris->stato != "D"){
					$_SESSION["login"] = $ris->user_name;
					if($ris->stato == "P"){
						$_SESSION['num_Ricerche'] = $MAX_SEARCH;
					}
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
	include "/lib/ac_base.php";
	ac_header("m.index.php");
	ac_initSection("Show/Hide", true, false);
?>
<!-- -.-.-.-.-.-.-.-.-.-.-.-.-.-.- SCRIVI LA TUA ROBA QUI' -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- -->
		
				<h1> Login </h1>
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<table style="padding:20px;">
						<tr><td>
						Nome Utente:</td><td> <input type="text" style="width:250px;" name="user"/></td></tr>
						<tr><td>
						Password:</td><td> <input type="password" style="width:250px;" name="password"/></td></tr>
						<tr><td colspan=2>
						<input type="submit" name="submit" value="Login" />
						</td></tr>
					</table>
				</form>
				
<?php
	ac_finalizeSection();
	ac_initSection("Se non sei registrato, clicca qu&igrave; per registrarti", false, true);
?>
				<h1> Registrati </h1>
				<p>Invia una richiesta di registrazione, un'e-mail ti notificher&agrave; l'inoltro della richiesta, nel giro di qualche giorno una seconda e-mail ti comunicher&agrave; i tuoi dati di accesso.</p>
				<p class="ac-important">Compila tutti i campi</p>
				<form style="text-align: left;" method="POST" action="request_insert.php">
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
<?php
	ac_finalizeSection();
	ac_footer();
?>
	
<!-- -.-.-.-.-.-.-.-.-.-.-.-.-.-.- STOP -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- -->