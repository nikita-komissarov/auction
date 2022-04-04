<?php

  if(!isset($_POST['id']) || empty($_POST['id']) || !is_numeric($_POST['id'])) exit();

  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

  //if(!$admin) exit();

  $item = R::findOne('items', 'id = ?', [$_POST['id']]);
  $stocks = R::findAll('stock');
  $category = R::findOne('items__categories', 'id = ?', [$item->category_id]);

  $instance = stream_socket_client('tcp://127.0.0.1:8000');
  fwrite($instance, 'send');

  $result = [
    'info' => [
      'article' => $item->article,
      'category' => [
        'id' => (int)$category->id,
        'name' => $category->name,
      ],
      'name' => $item->name,
      'media' => $item->media,
      'market' => $item->market,
      'description' => $item->description,
      'price' => (float)$item->price,
    ],
    'stocks' => [],
  ];

  foreach($stocks as $key => $stock) {
    $stock_item = R::findOne('stock__items', 'stock_id = ? AND item_id = ?', [$stock->id, $item->id]);
    $result['stocks'][] = [
      'id' => (int)$stock->id,
      'name' => $stock->name,
      'address' => $stock->address,
      //Сущность склада
      'count' => (int)$stock_item->count ?: 0,
      'rack' => $stock_item->rack ?: 'AAAA',
      'cell' => (int)$stock_item->cell ?: 0,
    ];
  }

  exit(json_encode($result));

?>