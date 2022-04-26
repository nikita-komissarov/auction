<?php

  if(!isset($_POST['item']) || empty($_POST['item']) || !is_numeric($_POST['item'])) exit();
  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

  //if(!$admin) exit();

  $item = R::findOne('items', 'id = ?', [$_POST['item']]);
  if(!$item) exit();

  $data = R::findAll('stock__items', 'item_id = ? AND added = 0', [$_POST['item']]);
  if(!$data) exit();

  $results = [];
  foreach($data as $key => $entry) {
    $results[] = [
      'id' => (int)$entry->id,
      'stock_id' => (int)$entry->stock_id,
      'article' => (int)$entry->article,
      'create_time' => (int)$entry->create_time,
      'price' => (float)$entry->price,
    ];
  }
  exit(json_encode($results));

?>