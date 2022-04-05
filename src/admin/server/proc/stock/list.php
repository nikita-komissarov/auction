<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

  //if(!$admin) exit();

  $stocks = R::findAll('stock');
  $results = [];

  foreach($stocks as $key => $stock) {
    $results[] = [
      'id' => (int)$stock->id,
      'name' => $stock->name,
      'address' => $stock->address,
    ];
  }

  exit(json_encode($results));

?>