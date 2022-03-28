<?php
	require_once __DIR__.'/settings.php';
	require_once __DIR__.'/libs/redbean.php';

	if(DB_SERVER_IP != 'localhost'){
		$rootdb = new PDO('mysql:host='.DB_SERVER_IP.';dbname='.DB_TABLE, DB_USER, DB_PASS, [
			PDO::MYSQL_ATTR_SSL_CA => dirname(__FILE__).'/ssl/database.crt',
	    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
	  ]);
  	$link = R::setup($rootdb);
  }
  else $link = R::setup('mysql:host='.DB_SERVER_IP.';dbname='.DB_TABLE, DB_USER, DB_PASS);
  if(!R::testconnection()) exit(header("HTTP/1.0 521 Web Server Is Down"));

  //R::freeze(true);

  R::ext('xdispense', function($type){
    return R::getRedBean()->dispense($type);
  });
?>
