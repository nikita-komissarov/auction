<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

  //if(!$admin) exit();

  $items = R::findAll('items');
  $categories = R::findAll('items__categories');
  $results = [];

  foreach($items as $key => $item) {
    $results[] = [
      'id' => $item->id,
      'name' => $item->name,
      'article' => $item->article,
      'price' => $item->price,
      'category' => [
        'id' => $item->category_id,
        'name' => $categories[$item->category_id]->name,
      ],
    ];
  }

  exit(json_encode($results));

?>