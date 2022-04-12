<?php

  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, viewport-fit=cover">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="theme-color" content="#fff">
  <meta http-equiv="Content-Security-Policy" content="default-src * 'self' 'unsafe-inline' 'unsafe-eval' data:">
  <title>Aksesshop</title>
  <link rel="stylesheet" href="/assets/css/core.css">
  <link rel="stylesheet" href="/assets/css/app.css">
  <link rel="apple-touch-icon" href="/assets/img/f7-icon-square.png">
  <link rel="icon" href="/assets/img/icons/favicon.png">
</head>

<body>
  <div id="app">
    <?php if($admin) : ?>
    <div class="panel panel-left panel-cover panel-push panel-init panel-border" data-visible-breakpoint="960">
      <div class="page">
        <div class="page-content">
          <div class="block-title">Основное</div>
          <div class="list links-list">
            <ul>
              <li>
                <a href="/accordion/" class="panel-close">Статистика</a>
              </li>
            </ul>
          </div>
          <div class="block-title">Лоты</div>
          <div class="list links-list">
            <ul>
              <li>
                <a href="/lot/create/" class="panel-close">Создать новый</a>
              </li>
              <li>
                <a href="/action-sheet/" class="panel-close">Запланированные</a>
              </li>
              <li>
                <a href="/badge/" class="panel-close">Завершенные</a>
              </li>
            </ul>
          </div>
          <div class="block-title">Магазин</div>
          <div class="list links-list">
            <ul>
              <li>
                <a href="/lot/create/" class="panel-close">Совершить продажу</a>
              </li>
              <li>
                <a href="/shop/create/" class="panel-close">Добавить товар</a>
              </li>
            </ul>
          </div>
          <div class="block-title">Склад</div>
          <div class="list links-list">
            <ul>
              <li>
                <a href="/stock/search/" class="panel-close">Поиск товара</a>
              </li>
              <li>
                <a href="/badge/" class="panel-close">Ожидающие медиа</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-right panel-reveal panel-resizable panel-init">
      <div class="view view-init view-right" data-name="right" data-url="/">
        <div class="page">
          <div class="navbar">
            <div class="navbar-bg"></div>
            <div class="navbar-inner sliding">
              <div class="title">Right Panel</div>
            </div>
          </div>
          <div class="page-content">
            <div class="block">
              <p>This is a right side panel. You can close it by clicking outsite or on this link: <a href="#"
                  class="panel-close">close me</a>. You can put here anything, even another isolated view.</p>
            </div>
            <div class="block-title">Panel Navigation</div>
            <div class="list links-list">
              <ul>
                <li><a href="/panel-right-1/">Right panel page 1</a></li>
                <li><a href="/panel-right-2/">Right panel page 2</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="view view-main view-init safe-areas" data-master-detail-breakpoint="768" data-url="/stock/item/media/2/"></div>
    <?php else : ?>
    <div class="view view-main view-init safe-areas" data-master-detail-breakpoint="768" data-url="/auth/"></div>
    <?php endif; ?>
  </div>
  <script src="/assets/js/core.js"></script>
  <script src="/assets/js/moment.js"></script>
  <script src="/assets/js/routes.js"></script>
  <script src="/assets/js/store.js"></script>
  <script src="/assets/js/app.js"></script>
</body>

</html>
