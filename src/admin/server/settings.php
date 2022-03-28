<?php

  define('THIS_SERVER_IP', getHostByName('localhost'));
  if(THIS_SERVER_IP == '127.0.0.1') {
    define('DB_SERVER_IP', 'localhost');
    define('WS_SERVER_IP', 'localhost');
    define('WS_SERVER_NAT', 'localhost');
    define('YANDEX_DEFAULT_BUCKET', 'auction.dev');
    define('THIS_DOMAIN', 'http://localhost');
  }
  else {
    define('DB_SERVER_IP', 'rc1a-330t87y7ql55kdcy.mdb.yandexcloud.net');
    define('WS_SERVER_IP', 'data.auction.ru');
    define('WS_SERVER_NAT', getHostByName('internal'));
    define('YANDEX_DEFAULT_BUCKET', 'auction.data');
    define('THIS_DOMAIN', 'https://auction.ru');
  }

  //DATABASE
  define('DB_TABLE', 'auction');
  define('DB_USER', 'auction');
  define('DB_PASS', 'fb8fcddc705541ff89c66ed031bcf90b');