<?php

  if(!isset($_POST['item']) || empty($_POST['item']) || !is_numeric($_POST['item'])) exit();

	require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

	$item = R::findOne('items', 'id = ?', [$_POST['item']]);
  if(!$item) exit();

  $dir = 'media/items/'.$_POST['item'].'/';
  $list_files = yandexObjectStorageList($dir);

  foreach($list_files as $key => $file) {
  	yandexObjectStorageDelete($file);
  }

  $item->media = null;
  R::store($item);

	exit(json_encode('ok'));
?>