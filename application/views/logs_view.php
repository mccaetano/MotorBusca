<?php /* file: ./application/views/_box_view_errors.php */ ?>
<!doctype html>
<html>
<head>
<title>View errors</title>
</head>
<body>
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
					
					// maybe delete
					echo '<p>' . anchor ( 'popup_view_errors/delete_log_file', 'Delete log file' ) . '</p>';
				} else {
					// notification
					echo  '<p>It&#39; gone: ' . $ff.'</p>';
				}
				?>
  </div>
</body>
</html>
