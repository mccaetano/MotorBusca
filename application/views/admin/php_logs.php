<div>
<?php

if (@is_file($log_path)) {
	echo nl2br(@file_get_contents($log_path));
} else {
	echo 'The log cannot be found in the specified route '.$log_path;
}

?>
</div>