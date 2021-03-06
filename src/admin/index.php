<?php

  require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';
?>

<!DOCTYPE html>
<html lang="ru-RU">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, viewport-fit=cover">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="theme-color" content="#fff">
  <meta http-equiv="Content-Security-Policy" content="default-src * 'self' 'unsafe-inline' 'unsafe-eval' data:">
  <title>REUC.MARKET | C-Panel</title>
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
          <div class="list">
            <ul>
              <li>
                <a href="#" class="panel-close item-link item-content">
                  <div class="item-media"><i class="f7-icons">chart_bar</i></div>
                  <div class="item-inner">
                    <div class="item-title">Статистика</div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#" class="panel-close item-link item-content">
                  <div class="item-media"><i class="f7-icons">gear</i></div>
                  <div class="item-inner">
                    <div class="item-title">Настройки</div>
                  </div>
                </a>
              </li>
            </ul>
          </div>
          <div class="block-title">Магазин</div>
          <div class="list">
            <ul>
              <li>
                <a href="#" class="panel-close item-link item-content">
                  <div class="item-media"><i class="f7-icons">cart</i></div>
                  <div class="item-inner">
                    <div class="item-title">Продажа</div>
                    <div class="item-after"><span class="badge color-blue">3</span></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#" class="panel-close item-link item-content">
                  <div class="item-media"><i class="f7-icons">archivebox</i></div>
                  <div class="item-inner">
                    <div class="item-title">История продаж</div>
                  </div>
                </a>
              </li>
            </ul>
          </div>
          <div class="block-title">Склад</div>
          <div class="list">
            <ul>
              <li>
                <a href="/stock/create/" class="panel-close item-link item-content">
                  <div class="item-media"><i class="f7-icons">plus</i></div>
                  <div class="item-inner">
                    <div class="item-title">Добавить товар</div>
                  </div>
                </a>
              </li>
              <li>
                <a href="/stock/search/" class="panel-close item-link item-content">
                  <div class="item-media"><i class="f7-icons">search</i></div>
                  <div class="item-inner">
                    <div class="item-title">Поиск товара</div>
                  </div>
                </a>
              </li>
              <li>
                <a href="/stock/search/?filter=4" class="panel-close item-link item-content">
                  <div class="item-media"><i class="f7-icons">camera_on_rectangle</i></div>
                  <div class="item-inner">
                    <div class="item-title">Без фотографий</div>
                    <div class="item-after" id="menu-count-photo"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="/stock/search/?filter=6" class="panel-close item-link item-content">
                  <div class="item-media"><i class="f7-icons">text_badge_xmark</i></div>
                  <div class="item-inner">
                    <div class="item-title">Без описания</div>
                    <div class="item-after" id="menu-count-description"></div>
                  </div>
                </a>
              </li>
            </ul>
          </div>
          <div class="block-title">Аукцион</div>
          <div class="list">
            <ul>
              <li>
                <a href="/lot/create/" class="panel-close item-link item-content">
                  <div class="item-media"><i class="f7-icons">plus</i></div>
                  <div class="item-inner">
                    <div class="item-title">Создать лот</div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#" class="panel-close item-link item-content">
                  <div class="item-media"><i class="f7-icons">search</i></div>
                  <div class="item-inner">
                    <div class="item-title">Поиск лота</div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#" class="panel-close item-link item-content">
                  <div class="item-media"><i class="f7-icons">timer</i></div>
                  <div class="item-inner">
                    <div class="item-title">Будущие</div>
                    <div class="item-after"><span class="badge">2</span></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#" class="panel-close item-link item-content">
                  <div class="item-media"><i class="f7-icons">chevron_right_2</i></div>
                  <div class="item-inner">
                    <div class="item-title">На торгах</div>
                    <div class="item-after"><span class="badge">4</span></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#" class="panel-close item-link item-content">
                  <div class="item-media"><i class="f7-icons">status</i></div>
                  <div class="item-inner">
                    <div class="item-title">Завершенные</div>
                    <div class="item-after"><span class="badge">3</span></div>
                  </div>
                </a>
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
    <div class="view view-main view-init safe-areas" data-master-detail-breakpoint="768" data-url="/stock/item/2/"></div>
    <?php else : ?>
    <div class="view view-main view-init safe-areas" data-master-detail-breakpoint="768" data-url="/auth/"></div>
    <?php endif; ?>
  </div>
  <script src="/assets/js/core.js"></script>
  <script src="/assets/js/moment.js"></script>
  <script src="/assets/js/routes.js"></script>
  <script src="/assets/js/store.js"></script>
  <!-- Скрипт приложения загружается в store.js после получения списка товаров -->
</body>

</html>
