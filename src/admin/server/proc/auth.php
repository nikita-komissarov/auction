<?php

  if(!isset($_POST['username']) || empty($_POST['username']) || strlen($_POST['username']) > 32) exit();
  if(!isset($_POST['password']) || empty($_POST['password']) || strlen($_POST['password']) > 256) exit();

  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

  $account = R::findOne('admins', 'username = ? AND password = ?', [$_POST['username'], $_POST['password']]);

  if($account) {
    $session_key = md5(time());
    $lifetime = time() + 604800;

    $session = R::xdispense('admins__sessions');
    $session->session_id = $session_key;
    $session->admin_id = $account->id;
    $session->admin_id = $account->id;
    $session->lifetime = $lifetime;
    $session->stamp = time();
    R::store($session);

    setcookie('AUCTION-ADMIN-ID', $session_key, $lifetime, '/');
    exit(json_encode('ok'));
  }
  else exit(json_encode('error'));

?>