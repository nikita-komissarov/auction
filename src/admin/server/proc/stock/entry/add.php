<?php

  if(!isset($_POST['item']) || empty($_POST['item']) || !is_numeric($_POST['item'])) exit();
  if(!isset($_POST['price']) || !is_numeric($_POST['price'])) exit();
  if(!isset($_POST['amount']) || empty($_POST['amount']) || !is_numeric($_POST['amount'])) exit();
  if($_POST['amount'] > 500) exit();
  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

  //if(!$admin) exit();

  $item = R::findOne('items', 'id = ?', [$_POST['item']]);
  if(!$item) exit();

  $time = time();
  for ($i = 0; $i < $_POST['amount']; $i++) { 

    $stock_item = R::xdispense('stock__items');
    $stock_item->item_id = $_POST['item'];
    $stock_item->stock_id = null;
    $stock_item->price = $_POST['price'];
    $stock_item->create_time = $time;
    R::store($stock_item);
    $stock_item->article = generateArticle($stock_item->id);
    R::store($stock_item);
  }

  sendSocket([
    'cmd' => 'change item',
    'item_id' => +$_POST['item'],
  ]);
  exit(json_encode($_POST['amount']));

?>