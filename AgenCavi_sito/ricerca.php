<!--
	PARAMETRI USATI:
	
	from: parametro passato con GET. serve a reindirizzare l'utente dopo il login nel caso in cui arrivi da QR_CODE
	
	prod: prodotto ricercato passato in GET
	
	password: password passata in POST

-->

<?php
	include "/lib/funzioni_mysql.php";
	
	/**
 * Redirect with POST data.
 *
 * @param string $url URL.
 * @param array $post_data POST data. Example: array('foo' => 'var', 'id' => 123)
 * @param array $headers Optional. Extra headers to send.
 */
function redirect_post($url, array $data, array $headers = null) {
	?>
	<form method="POST" action="<?php echo $url; ?>" name="re_frm">
	<?php 
		foreach ( $data as $ke => $va ){
	?>
		<input type="hidden" name="<?php echo $ke; ?>" value="<?php echo $va; ?>" />
	<?php
		}
	?>
	</form>
	<script language="JavaScript">
		document.re_frm.submit();
	</script>
	<?php
}
	
	$error_message = "";
	//IL CODICE PHP LO DEVO ANCORA SISTEMARE PER QUESTA PAGINA
	session_start();
	if(!isset($_SESSION["login"])){
		
		redirect_post("index.php", array("from" => "".$_SERVER['PHP_SELF'].""));
		die();
	}
	
	if(isset($_GET["prod"])){
		$prod_id = $_GET["prod"];
		
		if( ($file = fopen($prod_id.'.pdf', 'r')) ) {
			$exists = true;
			fclose($file);
		}
		else {
			$exists = false;
		}
	
		if($exists){
			$data = new MysqlClass();
			$data->connetti();
			
			//salvataggio nella tabella di log
			$id_utente = substr($_SESSION["login"],0);
			
			$t = "log"; # nome della tabella
			$v = array ($id_utente,$prod_id); # valori da inserire
			$r =  "user_name,prodotto"; # campi da popolare
			
			$data->inserisci($t,$v,$r);
			
			$data->disconnetti();
			//reindirizzamento al file cercato
			 
			 //APRIN NUOVA FINESTRA COL PDF
			echo 	('<script type="text/javascript" language="javascript"> 
					var win = window.open("http://127.0.0.1/AgenCavi_sito/'.(string)$prod_id .'.pdf");
					if(win){
						win.focus();
					}else{

						alert("Please allow popups for this site");
					}
					</script>'); 

		}else{
			//PANNELLO PRODOTTO NON TROVATO
			$error_message = "<p style='color:red;'>password errata</p>";
		}
	}
	
include "/lib/ac_base.php";
ac_header("m.ricerca.php");
ac_initSection("Show/Hide", true, false);
?>

<!-- -.-.-.-.-.-.-.-.-.-.-.-.-.-.- SCRIVI LA TUA ROBA QUI' -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- -->

						<div >
							<h1> Area Clienti </h1>
							<p>Sezione riservata a clienti Agencavi System. Per richiedere i dati di accesso, contattare direttamente la societ&agrave;</p>
							<h3> Cerca Collaudo </h3>
							<form method="GET">
								<table >
									<tr><td>
									Inserire il codice del componente:</td><td> <input type="text" name="prod" style="width:250px;"/></td></tr>
									<tr><td colspan=2>
									<input type="submit" value="submit" />
									</td></tr>
								</table>
							</form>
							
							<?php echo $error_message; ?>
							
							<h3> Cercati di recente </h3>
							<ul>
							
							
								<?php
									if(!isset($_GET["prod"])){
												
									
									}
									$data = new MysqlClass();
									$data->connetti();
									
									$aut = $data->query("SELECT DISTINCT prodotto FROM `log` WHERE user_name = " . (string)$_SESSION['login'] ." ORDER BY time_stamp DESC LIMIT 5");
									
									if(!mysql_num_rows($aut)){
										echo "Non hai mai effettuato una ricerca! Provala Ora!!";
									}
									while($res = $data->estrai($aut)){
									
										echo "<li>
											<a href='".(string)$_SERVER['PHP_SELF']."?prod=" . (string)$res->prodotto . "'> $res->prodotto </a>
											</li>
										
										";
									}
									$data->disconnetti();
								?>
								
								
							</ul>
							<a href="disc.php">logout</a>
						</div>
			
<!-- -.-.-.-.-.-.-.-.-.-.-.-.-.-.- STOP -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- -->
<?php
	ac_finalizeSection();
	ac_footer();
?>