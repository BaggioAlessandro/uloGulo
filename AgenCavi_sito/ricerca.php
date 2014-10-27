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
?>
<!DOCTYPE html>
<html lang="it-IT">
<head>
<meta charset="UTF-8" />
<title>Home | Agencavi Systems</title>
<!-- Created by Artisteer v4.0.0.58475 -->
<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<link rel="stylesheet" href="http://agencavisystems.it/wp-content/themes/agencavi/style.css" media="screen" />
<link rel="pingback" href="http://agencavisystems.it/xmlrpc.php" />
<link rel="alternate" type="application/rss+xml" title="Agencavi Systems &raquo; Feed" href="http://agencavisystems.it/feed/" />
<link rel="alternate" type="application/rss+xml" title="Agencavi Systems &raquo; Feed dei commenti" href="http://agencavisystems.it/comments/feed/" />
<link rel="alternate" type="application/rss+xml" title="Agencavi Systems &raquo; Home Feed dei commenti" href="http://agencavisystems.it/home/feed/" />
<link rel='stylesheet' id='bp-legacy-css-css'  href='http://agencavisystems.it/wp-content/plugins/buddypress/bp-templates/bp-legacy/css/buddypress.css?ver=2.0' type='text/css' media='screen' />
<link rel='stylesheet' id='site-categories-styles-css'  href='http://agencavisystems.it/wp-content/plugins/site-categories/css/site-categories-styles.css?ver=4.0' type='text/css' media='all' />
<!--[if lte IE 7]>
<link rel='stylesheet' id='style.ie7.css-css'  href='http://agencavisystems.it/wp-content/themes/agencavi/style.ie7.css?ver=4.0' type='text/css' media='screen' />
<![endif]-->
<link rel='stylesheet' id='style.responsive.css-css'  href='http://agencavisystems.it/wp-content/themes/agencavi/style.responsive.css?ver=4.0' type='text/css' media='all' />
<script type='text/javascript' src='http://agencavisystems.it/wp-content/themes/agencavi/jquery.js?ver=4.0'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var BP_DTheme = {"accepted":"Accepted","close":"Close","comments":"comments","leave_group_confirm":"Are you sure you want to leave this group?","mark_as_fav":"Favorite","my_favs":"My Favorites","rejected":"Rejected","remove_fav":"Remove Favorite","show_all":"Show all","show_all_comments":"Show all comments for this thread","show_x_comments":"Show all %d comments","unsaved_changes":"Your profile has unsaved changes. If you leave the page, the changes will be lost.","view":"View"};
/* ]]> */
</script>
<script type='text/javascript' src='http://agencavisystems.it/wp-content/plugins/buddypress/bp-templates/bp-legacy/js/buddypress.js?ver=2.0'></script>
<script type='text/javascript' src='http://agencavisystems.it/wp-content/themes/agencavi/script.js?ver=4.0'></script>
<script type='text/javascript' src='http://agencavisystems.it/wp-content/themes/agencavi/script.responsive.js?ver=4.0'></script>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://agencavisystems.it/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://agencavisystems.it/wp-includes/wlwmanifest.xml" /> 
<link rel='shortlink' href='http://agencavisystems.it/' />

	<script type="text/javascript">var ajaxurl = 'http://agencavisystems.it/wp-admin/admin-ajax.php';</script>

	<link rel='canonical' href='http://agencavisystems.it/' />
	<meta name="description" content="CABLAGGI STANDARD  Agencavi Systems fornisce cablaggi standard per tutti i principali sistemi di automazione industriale: Siemens, Fanuc, Control Techni..." />

<meta http-equiv="Content-Language" content="it-IT" />
<style type="text/css" media="screen">
.qtrans_flag span { display:none }
.qtrans_flag { height:12px; width:18px; display:block }
.qtrans_flag_and_text { padding-left:20px }
.qtrans_flag_en { background:url(http://agencavisystems.it/wp-content/plugins/qtranslate/flags/gb.png) no-repeat }
.qtrans_flag_it { background:url(http://agencavisystems.it/wp-content/plugins/qtranslate/flags/it.png) no-repeat }
.qtrans_flag_ru { background:url(http://agencavisystems.it/wp-content/plugins/qtranslate/flags/ru.png) no-repeat }
</style>
<link hreflang="en" href="http://agencavisystems.it/en/" rel="alternate" />
<link hreflang="ru" href="http://agencavisystems.it/ru/" rel="alternate" />
<style>.art-content .post-7 .layout-item-0 { color: #DBDBDB; background: #333333; padding: 10px;  }
.art-content .post-7 .layout-item-1 { color: #D4D4D4; background: #555555; padding: 10px;  }
.art-content .post-7 .layout-item-2 { padding: 20px;  }
.ie7 .post .layout-cell {border:none !important; padding:0 !important; }
.ie6 .post .layout-cell {border:none !important; padding:0 !important; }

</style></head>
<body class="home-page home page page-id-7 page-template-default no-js">

<div id="art-main">

<header class="clearfix art-header"><div class="art-widget widget widget_qtranslate" id="qtranslate-9" ><div class="art-widget-title">Lingua</div><div class="art-widget-content"><ul class="qtrans_language_chooser" id="qtranslate-9-chooser"><li class="lang-en"><a href="http://agencavisystems.it/en/" hreflang="en" title="English" class="qtrans_flag qtrans_flag_en"><span style="display:none">English</span></a></li><li class="lang-it active"><a href="http://agencavisystems.it/" hreflang="it" title="Italiano" class="qtrans_flag qtrans_flag_it"><span style="display:none">Italiano</span></a></li><li class="lang-ru"><a href="http://agencavisystems.it/ru/" hreflang="ru" title="???????" class="qtrans_flag qtrans_flag_ru"><span style="display:none">???????</span></a></li></ul><div class="qtrans_widget_end"></div></div></div>

<div class="art-slider art-slidecontainerheader">
    <div class="art-slider-inner">
<div class="art-slide-item art-slideheader0">

</div>
<div class="art-slide-item art-slideheader1">

</div>
<div class="art-slide-item art-slideheader2">

</div>
<div class="art-slide-item art-slideheader3">

</div>

    </div>
</div>


<div class="art-slidenavigator art-slidenavigatorheader">
<a href="#" class="art-slidenavigatoritem"></a><a href="#" class="art-slidenavigatoritem"></a><a href="#" class="art-slidenavigatoritem"></a><a href="#" class="art-slidenavigatoritem"></a>
</div>




    <div class="art-shapes">


            </div>

<nav class="art-nav clearfix">
    
<ul class="art-hmenu menu-2">
	<li class="menu-item-13 active"><a title="Home" href="http://agencavisystems.it/" class="active">Home</a>
	</li>
	<li class="menu-item-79"><a title="Azienda" href="#">Azienda</a>
	<ul>
		<li class="menu-item-48"><a title="Chi siamo" href="http://agencavisystems.it/azienda/chi-siamo/">Chi siamo</a>
		</li>
		<li class="menu-item-47"><a title="Produzione" href="http://agencavisystems.it/azienda/produzione/">Produzione</a>
		</li>
		<li class="menu-item-46"><a title="Qualità" href="http://agencavisystems.it/azienda/qualita/">Qualità</a>
		</li>
		<li class="menu-item-45"><a title="Fiere ed eventi" href="http://agencavisystems.it/azienda/fiere-ed-eventi/">Fiere ed eventi</a>
		</li>
		<li class="menu-item-44"><a title="Ultime novità" href="http://agencavisystems.it/azienda/ultime-novita/">Ultime novità</a>
		</li>
	</ul>
	</li>
	<li class="menu-item-15"><a title="Prodotti" href="http://agencavisystems.it/prodotti/">Prodotti</a>
	<ul>
		<li class="menu-item-64"><a title="Cablaggi standard" href="http://agencavisystems.it/prodotti/cablaggi-standard/">Cablaggi standard</a>
		</li>
		<li class="menu-item-63"><a title="Cablaggi custom" href="http://agencavisystems.it/prodotti/cablaggi-custom/">Cablaggi custom</a>
		</li>
		<li class="menu-item-62"><a title="Sistema Plug&amp;Play" href="http://agencavisystems.it/prodotti/sistema-plugplay/">Sistema Plug&#038;Play</a>
		</li>
		<li class="menu-item-61"><a title="Connettori" href="http://agencavisystems.it/prodotti/connettori/">Connettori</a>
		</li>
	</ul>
	</li>
	<li class="menu-item-16"><a title="Rete vendita" href="http://agencavisystems.it/rete-vendita/">Rete vendita</a>
	</li>
	<li class="menu-item-17"><a title="Partners" href="http://agencavisystems.it/partners/">Partners</a>
	</li>
	<li class="menu-item-18"><a title="Contatti" href="http://agencavisystems.it/contatti/">Contatti</a>
	</li>
</ul>
 
    </nav>

                    
</header>

<div class="art-sheet clearfix">
            <div class="art-layout-wrapper clearfix">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content clearfix">
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
                        </div>
                    </div>
                </div>
            </div>
    </div>
<footer class="art-footer clearfix">  <div class="art-footer-inner">
<div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 24%">
        <p style="font: 18px 'Trebuchet MS'; color: #808080;"><span style="color: #FFFFFF;">Agencavi Systems s.r.l.</span></p>
        <br>
        <p>Via Martiri della Libertà, 4<br>
        20096 Liscate (MI)</p>
        <p>Tel. +39.02.45914051<br>
        Fax. +39.02.95350513</p>
        <p><a href="mailto:info@agenavisystems.it">info@agenavisystems.it</a></p>
    </div><div class="art-layout-cell layout-item-0" style="width: 24%">
        <p style="font: 18px 'Trebuchet MS'; color: #808080;"><br></p>
        <div style="margin-left: 2em">         </div>
    </div><div class="art-layout-cell layout-item-0" style="width: 22%">
        <p style="font: 18px 'Trebuchet MS'; color: #808080;"><br></p>
        <div style="margin-left: 2em">         </div>
    </div><div class="art-layout-cell layout-item-0" style="width: 30%">
        <p style="text-align: right;"><br></p>
        <br>
        <br>
        <p style="text-align: right;">Copyright © 2014 Agencavi Systems.</p>
        <p style="text-align: right;">Tutti di diritti riservati.</p>
    </div>
    </div>
</div>

  </div>
</footer>

</div>



<div id="wp-footer">
	
<!-- Generated in 0,491 seconds. (83 q) -->

		<!-- 83 queries. 0,491 seconds. -->
</div>
</body>
</html>