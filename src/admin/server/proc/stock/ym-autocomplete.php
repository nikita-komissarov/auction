<?php

  if(!isset($_POST['id']) || empty($_POST['id']) || !is_numeric($_POST['id'])) exit();

  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

  //if(!$admin) exit();

  function ymScannerRequest($method, $post = [])
  {
    if(!$post) return [];
    $post['key'] = YMSCANNER_TOKEN;
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, 'https://ymscanner.com/api/'.$method);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 900);
    curl_setopt($curl, CURLOPT_TIMEOUT, 900);

    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);

    $data = curl_exec($curl);
    curl_close($curl);

    if($data) $data = json_decode($data);
    return $data;
  }

  $result = [
    'info' => ymScannerRequest('info', ['id' => $_POST['id']]),
    'specs' => ymScannerRequest('specs', ['id' => $_POST['id']])
  ];

  exit(json_encode($result));

?>