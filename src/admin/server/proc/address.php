<?php
	if(!isset($_POST['type']) || empty($_POST['type'])) exit();
	if(!isset($_POST['query']) || empty($_POST['query'])) exit();

	require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

	$dadata = new \Dadata\DadataClient(DADATA_TOKEN, DADATA_SECRET);
	$results = [];

	if($_POST['type'] == 'full'){
		$response = $dadata->suggest('address', $_POST['query'], 5);
	}
	else if($_POST['type'] == 'city'){
		$response = $dadata->suggest('address', $_POST['query'], 1, [
			"from_bound" => ['value' => 'city'],
			"to_bound" => ['value' => 'city'],
		]);
	}

	foreach($response as $data) {
		if($_POST['type'] == 'full') $results[] = $data['value'];
		else $results[] = $data['data']['city'];
	}
		
	echo json_encode($results);
?>