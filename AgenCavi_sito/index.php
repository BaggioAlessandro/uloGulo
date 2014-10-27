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
	include "/lib/ac_base.php";
	ac_header("m.index.php");
	ac_initSection("Show/Hide", true, false);
?>
<!-- -.-.-.-.-.-.-.-.-.-.-.-.-.-.- SCRIVI LA TUA ROBA QUI' -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- -->
		
				<h1 class="art-postheader"> Login </h1>
				<p align="justify" style="padding:20px;">Sezione riservata a proprietari di cavi siglati</p>
				<h3 style="padding:20px; color:orange; font-size:170%;"> Login </h3>
				<form style="text-align: left;" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<table style="padding:20px;">
						<tr><td>
						Nome Utente:</td><td> <input type="int" style="width:250px;" name="user"/></td></tr>
						<tr><td>
						Password:</td><td> <input type="password" style="width:250px;" name="password"/></td></tr>
						<tr><td colspan=2>
						<input type="submit" name="submit" value="Login" />
						</td></tr>
					</table>
				</form>
<?php
	ac_finalizeSection();
	ac_initSection("Registrazione", false, true);
?>
				<h1 class="art-postheader"> Registrati </h1>
				<p align="justify" style="padding:20px;">Invia una richiesta di registrazione, un'e-mail ti notificher&agrave; l'avvenuta accettazione</p>
				<h3 style="padding:20px; color:orange; font-size:170%;"> Login </h3>
				<form style="text-align: left;" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<table style="padding:20px;">
						<tr><td>
						Nome Utente:</td><td> <input type="int" style="width:250px;" name="user"/></td></tr>
						<tr><td>
						Password:</td><td> <input type="password" style="width:250px;" name="password"/></td></tr>
						<tr><td colspan=2>
						<input type="submit" name="submit" value="Login" />
						</td></tr>
					</table>
				</form>
<?php
	ac_finalizeSection();
	ac_footer();
?>
	
<!-- -.-.-.-.-.-.-.-.-.-.-.-.-.-.- STOP -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- -->