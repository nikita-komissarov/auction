<?php
  if(!isset($_POST['article']) || empty($_POST['article']) || !is_numeric($_POST['article'])) exit();
  if(!isset($_POST['name']) || empty($_POST['name'])) exit();
  if(!isset($_POST['category']) || empty($_POST['category']) || !is_numeric($_POST['category'])) exit();

  if(!isset($_POST['price'])) exit();
  if(!isset($_POST['marketId'])) exit();
  if(!isset($_POST['marketUrl'])) exit();
  if(!isset($_POST['description'])) exit();

  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

  //if(!$admin) exit();

  $check_article = R::count('items', 'article = ?', [$_POST['article']]);
  if($check_article) exit(json_encode('article is exist'));

  $item = R::xdispense('items');
  $item->article = $_POST['article'];
  $item->name = $_POST['name'];
  $item->category_id = $_POST['category'];

  $item->price = ($_POST['price'] ? $_POST['price'] : null);
  $item->market_id = ($_POST['marketId'] ? $_POST['marketId'] : null);
  $item->market_url = ($_POST['marketUrl'] ? $_POST['marketUrl'] : null);
  $item->description = ($_POST['description'] && $_POST['description'] != '<br>' ? $_POST['description'] : null);
  
  R::store($item);

  sendSocket([
    'cmd' => 'change item',
    'item_id' => +$item->id,
  ]);

  exit(json_encode('ok'));

?>