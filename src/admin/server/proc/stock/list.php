<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

  //if(!$admin) exit();

  $items = R::findAll('items');
  $categories = R::findAll('items__categories');
  $results = [];

  foreach($items as $key => $item) {
    $results[] = [
      'id' => (int)$item->id,
      'name' => $item->name,
      'article' => $item->article,
      'price' => (float)$item->price,
      'count' => (int)R::getCol('SELECT SUM(`count`) FROM `stock__items` WHERE `item_id` = '.$item->id)[0] ?: 0,
      'category' => [
        'id' => (int)$item->category_id,
        'name' => $categories[$item->category_id]->name,
      ],
    ];
  }

  exit(json_encode($results));

?>