<?php

	sleep(1);

	exit(json_encode([
		'post' => $_POST,
		'file' => $_FILES['file'],
	]));
?>