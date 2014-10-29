<?php

function redirect_post($url, array $data, array $headers = null) {
	echo '
	<form method="POST" action="'.$url.'" name="re_frm">';
	
	foreach ( $data as $ke => $va ){
		echo '
		<input type="hidden" name="'.$ke.'" value="'.$va.'" />';
	}
	
	echo '	
		</form>
		<script language="JavaScript">
			document.re_frm.submit();
		</script>';
}

function inoltro_post(array $data){
	foreach ( $data as $ke => $va ){
		echo '
		<input type="hidden" name="'.$ke.'" value="'.$va.'" />';
	}
}
?>