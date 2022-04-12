<?php

  if(!isset($_POST['url']) || empty($_POST['url'])) exit();

	require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

  $url = explode('.', $_POST['url']);
  $ext = array_pop($url);

  $file = file_get_contents(implode('.', $url).'.'.$ext);
  $base64 = base64_encode($file);

	exit('data:image/'.$ext.';base64,'.$base64);
?>