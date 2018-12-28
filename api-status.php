<?php
function apiStatus($num_err)
{
	switch ($num_err) {
		case 1:
			echo '{"status": "error", "kode": "' . $num_err . '", "text": "This method is not supported."}';
			break;
		case 2:
			echo '{"status": "error", "kode": "' . $num_err . '", "text": "Add post failed."}';
			break;
		case 3:
			echo '{"status": "error", "kode": "' . $num_err . '", "text": "Update post failed."}';
			break;
		case 4:
			echo '{"status": "error", "kode": "' . $num_err . '", "text": "Delete post failed."}';
			break;
		case 5:
			echo '{"status": "ok"}';
			break;
	}
}
?>
