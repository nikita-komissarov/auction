<?php

  if(!isset($_POST['username']) || empty($_POST['username']) || strlen($_POST['username']) > 32) exit();
  if(!isset($_POST['password']) || empty($_POST['password']) || strlen($_POST['password']) > 256) exit();

  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';

  $account = R::findOne('admins', 'username = ? AND password = ?', [$_POST['username'], $_POST['password']]);

  if($account) {
    $session_key = md5(time());

    $session = R::xdispense('admins_sessions');
    $session->session_id = $session_key;
    $session->admin_id = $account->id;
    R::store($session);

    setcookie('AUCTION-ADMIN-ID', $session_key, time() + 604800, '/');
    exit(json_encode('ok'));
  }
  else exit(json_encode('error'));