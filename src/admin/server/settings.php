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
  define('DB_TABLE', 'reuc');
  define('DB_USER', 'reuc');
  define('DB_PASS', 'fb8fcddc705541ff89c66ed031bcf90b');
  //Yandex.Cloud Storage
  define('YANDEX_CLOUD_STORAGE_BUCKET', 'auction.dev');
  define('YANDEX_CLOUD_STORAGE', [
    'credentials' => [
      'key'      => 'YCAJEJdTBUEsWaXYotl5B3K47',
      'secret'   => 'YCPUrPMeWzEuzNr4toHNRWgGFG3Bdrrs53EV6GJ7',
    ],
    'endpoint' => 'https://storage.yandexcloud.net',
    'region'   => 'ru-central1',
    'version'  => 'latest',
  ]);
  //DaData
  define('DADATA_TOKEN', '8ee449e223f617af130729df70868292783a7c56');
  define('DADATA_SECRET', 'b4cae5a1cb7205bb8927939bd65bc7ca9dc880ca');
  //ymScanner
  define('YMSCANNER_TOKEN', '4a22df1e409b6b09cf50f99f9f3f32b0');