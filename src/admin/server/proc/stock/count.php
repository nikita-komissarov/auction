<?php

  if(!isset($_POST['item']) || empty($_POST['item']) || !is_numeric($_POST['item'])) exit();
  if(!isset($_POST['stock']) || empty($_POST['stock']) || !is_numeric($_POST['stock'])) exit();
  if(!isset($_POST['val']) || ($_POST['val'] != -1 && $_POST['val'] != 1)) exit();

  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

  //if(!$admin) exit();

  $item = R::findOne('items', 'id = ?', [$_POST['item']]);
  if(!$item) exit();
  $stock = R::findOne('stock', 'id = ?', [$_POST['stock']]);
  if(!$stock) exit();

  $stock_item = R::findOne('stock__items', 'stock_id = ? AND item_id = ?', [$_POST['stock'], $_POST['item']]);
  if(!$stock_item){
    $stock_item = R::xdispense('stock__items');
    $stock_item->stock_id = $_POST['stock'];
    $stock_item->item_id = $_POST['item'];
    $stock_item->count = 0;
    $stock_item->rack = 'AAAA';
    $stock_item->cell = 0;
  }
  if($_POST['val'] == -1) $stock_item->count--;
  else $stock_item->count++;
  
  if($stock_item->count < 0) $stock_item->count = 0;

  R::store($stock_item);

  sendSocket([
    'cmd' => 'change item',
    'item_id' => +$_POST['item'],
  ]);
  exit(json_encode($stock_item->count));

?>