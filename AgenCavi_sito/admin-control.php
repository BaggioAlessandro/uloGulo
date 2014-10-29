<!--
	
	PARAMETRI USATI:
	
	from: parametro passato con GET. serve a reindirizzare l'utente dopo il login nel caso in cui arrivi da QR_CODE
	
	user: nome utente passato in POST
	
	password: password passata in POST

-->

<?php

	include "/lib/funzioni_mysql.php";
	include "/lib/redirect.php";
	
	/**
 * Redirect with POST data.
 *
 * @param string $url URL.
 * @param array $post_data POST data. Example: array('foo' => 'var', 'id' => 123)
 * @param array $headers Optional. Extra headers to send.
 */
	
	$var = "display: none;";
	//IL CODICE PHP LO DEVO ANCORA SISTEMARE PER QUESTA PAGINA
	session_start();
	$data = new MysqlClass();
	if($data->connetti()){
		$aut = $data->query("SELECT user_name,password FROM ac_admin WHERE user_name= '".$_SESSION['login']."'");
		if(!isset($_SESSION["login"])){
			header("Location: admin.php");
			die();
		}elseif(mysql_num_rows($aut) == 0 ){
			redirect_post("disc.php", array("go_to" => "admin.php"));
			header("Location: disc.php");
		}
	}
	else{
		echo "Errore di connessione";
	}
	
include "/lib/ac_base.php";
ac_header("m.ricerca.php");
ac_initSection("Show/Hide", true, false);
?>

<!-- -.-.-.-.-.-.-.-.-.-.-.-.-.-.- SCRIVI LA TUA ROBA QUI' -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- -->

						<div >
							<h1> Pannello di controllo </h1>
							<a href="disc.php">logout</a>
						</div>
			
<!-- -.-.-.-.-.-.-.-.-.-.-.-.-.-.- STOP -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- -->
<?php
	ac_finalizeSection();
	ac_footer();
?>