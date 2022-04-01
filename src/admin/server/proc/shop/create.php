<?php
  if(!isset($_POST['article']) || empty($_POST['article']) || !is_numeric($_POST['article'])) exit();
  if(!isset($_POST['name']) || empty($_POST['name'])) exit();
  if(!isset($_POST['category']) || empty($_POST['category']) || !is_numeric($_POST['category'])) exit();

  if(!isset($_POST['price'])) exit();
  if(!isset($_POST['market'])) exit();
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
  $item->market = ($_POST['market'] ? $_POST['market'] : null);
  $item->description = ($_POST['description'] && $_POST['description'] != '<br>' ? $_POST['description'] : null);
  
  R::store($item);

  exit(json_encode('ok'));

?>