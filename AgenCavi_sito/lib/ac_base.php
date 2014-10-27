<?php

	/*!
	*
	*
	*
	*/
	function ac_header(){
		$meta = "\t<meta charset=\"UTF-8\" />\n\t<meta http-equiv=\"Content-Language\" content=\"it-IT\" />\n";
		$title = "\t<title>CableCheck</title>\n";
		$js  = "\t<script src=\"js/jquery-1.11.0.min.js\"></script>\n";
		$css = "\t<link href = \"css/style.css\" rel = \"stylesheet\" type = \"text/css\" >\n";
		
		$head = "<!DOCTYPE html>\n<html lang=\"it-IT\">\n<head>\n".$meta.$title.$js.$css."</head>\n";
		
		echo $head;
		echo "<body>\n";
		echo "\t<div id=\"ac-container\">\n\t";
	}
	
	/*!
	*
	*
	*
	*/
	function ac_footer(){
		$footer = "";
		$script = "
		<script>
			$( \".ac-content-handle\" ).click(function () {
				var el = $( this ).parent().children(\".ac-content\");
				if ( el.is( \":hidden\" ) ) {
					el.slideDown( \"slow\" );
				} else {
					el.slideUp( \"slow\" );
				}
			});
		</script>\n";
		
		echo $footer."\t</div>\n".$script."</body>\n</html>";
	}
	
	function ac_initSection($handle, $visible, $wrappable){
		?>
		<div class="ac-content-box">
		<?php
			if ($wrappable == true){ ?>
			<div class="ac-content-handle">
				<?php echo $handle; ?>
			</div>
		<?php
			} ?>
			<div class="ac-content" style="display:<?php echo ($visible == true ? "block;" : "none;"); ?>">
				
		<?php
	}
	
	function ac_finalizeSection(){
		?>
			</div>
		</div>
		<?php
	}

?>