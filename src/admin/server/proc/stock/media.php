<?php

  if(!isset($_POST['item']) || empty($_POST['item']) || !is_numeric($_POST['item'])) exit();
  if(!isset($_POST['id']) || !is_numeric($_POST['item'])) exit();

	require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

	$item = R::findOne('items', 'id = ?', [$_POST['item']]);
  if(!$item) exit();

  $media_list = [];
  if($item->media) $media_list = json_decode($item->media);

  $dir = 'media/items/'.$_POST['item'].'/';
  $upload_file = $_FILES['file'];
  $file_ext = mime2ext(mime_content_type($upload_file['tmp_name']));

  $result = yandexObjectStoragePut($upload_file['tmp_name'], $dir, $_POST['id']);

  $media_list[] = YANDEX_CLOUD_STORAGE['endpoint'].'/'.YANDEX_CLOUD_STORAGE_BUCKET.'/'.$result;

  $item->media = json_encode($media_list);
  R::store($item);

	exit(json_encode($result));
?>