<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

  //if(!$admin) exit();

  $categories = R::findAll('items__categories');
  $results = [];

  foreach($categories as $key => $category) {
    $results[] = [
      'id' => (int)$category->id,
      'name' => $category->name,
    ];
  }

  exit(json_encode($results));

?>