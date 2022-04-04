<?php

  if(!isset($_POST['id']) || empty($_POST['id']) || !is_numeric($_POST['id'])) exit();

  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

  //if(!$admin) exit();

  $item = R::findOne('items', 'id = ?', [$_POST['id']]);
  $stocks = R::findAll('stock');
  $category = R::findOne('items__categories', 'id = ?', [$item->category_id]);

  $result = [
    'info' => [
      'article' => $item->article,
      'category' => [
        'id' => $category->id,
        'name' => $category->name,
      ],
      'name' => $item->name,
      'media' => $item->media,
      'market' => $item->market,
      'description' => $item->description,
      'price' => $item->price,
    ],
    'stocks' => [],
  ];

  foreach($stocks as $key => $stock) {
    $result['stocks'][] = [
      'id' => $stock->id,
      'name' => $stock->name,
      'address' => $stock->address,
      'count' => 0,
    ];
  }

  exit(json_encode($result));

?>