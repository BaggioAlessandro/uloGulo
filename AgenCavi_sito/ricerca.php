<!--
	PARAMETRI USATI:
	
	from: parametro passato con GET. serve a reindirizzare l'utente dopo il login nel caso in cui arrivi da QR_CODE
	
	prod: prodotto ricercato passato in GET
	
	password: password passata in POST

-->

<?php
	include "/lib/funzioni_mysql.php";
	//IL CODICE PHP LO DEVO ANCORA SISTEMARE PER QUESTA PAGINA
	session_start();
	if(!isset($_SESSION["login"])){
		header("Location: index.php?from=".$_SERVER["PHP_SELF"]);
	}
	
	if(isset($_GET["prod"])){
		$prod_id = $_GET["prod"];
		
		$file = 'http://127.0.0.1/AgenCavi_sito/"$prod_id".pdf';
		$file_headers = @get_headers($file);
		if( strcmp($file_headers[0],'HTTP/1.1 404 Not Found') != 0 ) {
			$exists = false;
		}
		else {
			$exists = true;
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
			echo("nessun prodotto trovato");
		}
	}
	
include "/lib/ac_base.php";
ac_header("m.ricerca.php");
ac_initSection("Show/Hide", true, false);
?>

<!-- -.-.-.-.-.-.-.-.-.-.-.-.-.-.- SCRIVI LA TUA ROBA QUI' -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- -->

						<div >
							<h1 class="art-postheader"> Area Clienti </h1>
							<p align="justify" style="padding:20px;">Sezione riservata a clienti Agencavi System. Per richiedere i dati di accesso, contattare direttamente la societ&agrave;</p>
							<h3 style="padding:10px; color:orange; font-size:150%;"> Cerca Collaudo </h3>
							<form style="text-align: left;" method="GET">
								<table style="padding:20px;">
									<tr><td>
									Inserire il codice del componente:</td><td> <input type="text" name="prod" style="width:250px;"/></td></tr>
									<tr><td colspan=2>
									<input type="submit" value="submit" />
									</td></tr>
								</table>
							</form>
							<h3 style="padding:10px; color:orange; font-size:150%;"> Cercati di recente </h3>
							<ul align="justify" style="padding:20px;">
							
							
								<?php
									if(!isset($_GET["prod"])){
												include "/Librerie/funzioni_mysql.php";
										$data = new MysqlClass();
									
									}
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