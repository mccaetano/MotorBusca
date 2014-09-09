	<div>
    <?php
				$ff = $log_path . 'log-' . date ( 'Y-m-d' ) . '.php';
				
				if (file_exists ( $ff )) {
					// get file in a string
					$ff = highlight_file ( $ff, TRUE );
					
					// cosmetic
					$ff = str_replace ( 'ERROR', '<br />Error<br />', $ff );
					
					// show errors
					echo $ff;					
					
				} else {
					// notification
					echo  '<p>It&#39; gone: ' . $ff.'</p>';
				}
				?>
  </div>
<script>
	window.scrollTo(0, document.body.scrollHeight);
</script>