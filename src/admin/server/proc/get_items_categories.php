<?php

  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

  //if(!$admin) exit();

  $data = R::findAll('items__categories');
  $categories = [];
  foreach($data as $key => $value) {
    $categories[] = [
      'id' => $value->id,
      'text' => $value->name,
    ];
  }
  exit(json_encode($categories));

?>