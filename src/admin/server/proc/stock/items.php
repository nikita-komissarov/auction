<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

  //if(!$admin) exit();

  if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
    $items = [R::findOne('items', 'id = ?', [$_GET['id']])];
    $categories = R::findAll('items__categories');
  }
  else{
    $items = R::findAll('items');
    $categories = R::findAll('items__categories');
  }
  $stocks = R::findAll('stock');
  $results = [];

  foreach($items as $key => $item) {
    $stock_data = [];

    foreach($stocks as $key => $stock) {
      $stock_item = R::findOne('stock__items', 'stock_id = ? AND item_id = ?', [$stock->id, $item->id]);
      $stock_data[(int)$stock->id] = [
        'count' => (int)$stock_item->count ?: 0,
        'rack' => $stock_item->rack ?: 'AAAA',
        'cell' => (int)$stock_item->cell ?: 0,
      ];
    };

    $results[] = [
      'id' => (int)$item->id,
      'info' => [
        'name' => $item->name,
        'article' => $item->article,
        'price' => (float)$item->price,
        'category' => [
          'id' => (int)$item->category_id,
          'name' => $categories[$item->category_id]->name,
        ],
        'media' => $item->media,
        'market' => $item->market,
        'description' => $item->description,
      ],
      'stock' => $stock_data,
    ];
  }
  
  exit(json_encode($results));

?>