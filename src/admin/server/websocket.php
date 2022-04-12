<?php

use Workerman\Worker;

require_once __DIR__.'/server.php';

// Create a Websocket server
$ws_worker = new Worker('websocket://localhost:7777');
$connections = [];

// Emitted when new connection come
$ws_worker->onConnect = function($connection) use (&$connections)
{
  $connection->onWebSocketConnect = function($connection, $request) use (&$connections)
  {
    $admin = R::findOne('admins__sessions', 'session_id = ?', [$_GET['key']]);
    if(!$admin) return false;
    $admin = R::findOne('admins', 'id = ?', [$admin->admin_id]);
    if(!$admin) return false;

    $connections[$admin->id][] = $connection;
    echo 'Подключился администратор '.$admin->username.''.PHP_EOL;
  };
};

$ws_worker->onWorkerStart = function() use (&$connections)
{
  $tcp_worker = new Worker('tcp://localhost:7778');
  $tcp_worker->onMessage = function($connection, $data) use (&$connections)
  {
    
    echo '<pre>'; print_r($data); echo '</pre>';
    foreach($connections as $connections_array) {
      foreach($connections_array as $connection) {
        if(!$connection) continue;
        $connection->send(json_encode($data));
      }
    }
  };
  $tcp_worker->listen();
};

function searchConnect($users, $needle){
  foreach($users as $id => $user){
    foreach ($user as $key => $connect) {
      if($connect == $needle){
        return (object)[
          'id' => $id,
          'connect' => $key,
        ];
      }
    }
  }
}

$ws_worker->onClose = function($connection) use (&$connections)
{
  $admin = searchConnect($connections, $connection);
  unset($connections[$admin->id][$admin->connect]);
};

// Run worker
Worker::runAll();