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
	
	if(!isset($_POST["interval"])){
		header("Location: admin-control.php");
	}
	if($data->connetti()){
		$aut = $data->query("SELECT user_name FROM ac_admin WHERE user_name= '".$_SESSION['admin_login']."'");
	
		if(!isset($_SESSION["admin_login"])){
			header("Location: admin.php");
			die();
		}elseif(mysql_num_rows($aut) == 0 ){
			redirect_post("disc.php", array("go_to" => "admin.php"));
			header("Location: disc.php");
		}
	}else{
		echo "Errore di connessione";
	}
	
include "/lib/ac_base.php";
ac_header("m.ricerca.php");
ac_initSection("Show/Hide", true, false);
?>

<!-- -.-.-.-.-.-.-.-.-.-.-.-.-.-.- SCRIVI LA TUA ROBA QUI' -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- -->

						<div >
							<h1> Pannello di controllo </h1>
							
							<h1> statistiche </h1>
							<a href="admin-control.php">back</a>
							<?php
								switch($_POST["interval"]){
									case 1:
										$interval = "INTERVAL 1 DAY";
										break;
									case 7:
										$interval = "INTERVAL 1 WEEK";
										break;
									case 30:
										$interval = "INTERVAL 1 MONTH";
										break;
									case 1000:
										$interval = "INTERVAL 100 YEAR";
										break;
									default:
										header("Location: admin-control.php");
										break;
								}
								$data = new MysqlClass();
								if($data->connetti()){
									if(strcmp($_POST["user"],"") == 0){
										$aut = $data->query("SELECT user_name, count(*) as number FROM `log` WHERE time_stamp > DATE_SUB(now(), " .$interval.") GROUP BY user_name");
										}
									else{
										$aut = $data->query("SELECT user_name,count(*) as number FROM `log` WHERE time_stamp > DATE_SUB(now(), " .$interval.") and  user_name = ".$_POST["user"]." GROUP BY user_name");
									}
									if(!mysql_num_rows($aut)){
										echo "Non ci sono state ricerche";
									}
									while($res = $data->estrai($aut)){
									
										echo "<li>
											$res->user_name, \t$res->number";
									}
									$data->disconnetti();
								
								
								}else{
									echo "connessione falllita";
								}
								
							?>
							<br></br>
							<a href="disc.php">logout</a>
						</div>
						
<?php
	ac_finalizeSection();
	//se arrivo da un request handler allora apro direttamente la sezione delle richieste pendenti
	if(isset($_POST["from"]) && strcmp($_POST["from"], "handler")==0){
		ac_initSection("Clicca qui per visualizzare le richieste pendenti", true, true);
	}else{
		ac_initSection("Clicca qui per visualizzare le richieste pendenti", false, true);
	}
?>
						<a name = "request"> </a>
						<div 
							<h1> Richieste Pendenti </h1>
							<?php
								$data = new MysqlClass();
								if($data->connetti()){
									
 									$aut = $data->query("SELECT user_name,nome,azienda,telefono FROM `utenti` WHERE stato = 'P'");
									if(!mysql_num_rows($aut)){
										echo "Non ci sono richieste pendenti";
									}
									while($res = $data->estrai($aut)){
									
										echo "<li>
											$res->user_name,$res->nome,$res->azienda";
											
										if($res->telefono != null){
											echo ",$res->telefono";
										}	
										echo "<form method = 'POST' style='display: inline-block; margin-left: 100px;'>";
										echo "<button type='submit' formaction ='request_handler_acc.php' name = 'user' value = '" .$res->user_name."'>Acc</button>";
										echo "<button type='submit' formaction ='request_handler_rif.php' name = 'user' value = '" .$res->user_name."'>Rif!</button>";
										echo "</form>";
										
										echo "</li>";
									}
									$data->disconnetti();
								
								
								}else{
									echo "connessione falllita";
								}								
							
							?>
						</div>
			
<!-- -.-.-.-.-.-.-.-.-.-.-.-.-.-.- STOP -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- -->


<?php
	ac_finalizeSection();
	ac_footer();
?>