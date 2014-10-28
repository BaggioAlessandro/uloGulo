<!--
	
	PARAMETRI USATI:
	
	from: parametro passato con GET. serve a reindirizzare l'utente dopo il login nel caso in cui arrivi da QR_CODE
	
	user: nome utente passato in POST
	
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
	
	$var = "display: none;";
	//IL CODICE PHP LO DEVO ANCORA SISTEMARE PER QUESTA PAGINA
	session_start();
	if(!isset($_SESSION["login"])){
		
		redirect_post("index.php", array("from" => "".$_SERVER['PHP_SELF'].""));
		die();
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