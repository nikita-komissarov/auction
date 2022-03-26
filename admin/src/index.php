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
    <div class="panel panel-left panel-cover panel-init" data-visible-breakpoint="960">
      <div class="page">
        <div class="page-content">
          <div class="block-title">Left Panel</div>
          <div class="block">
            <p>This is a left side panel. You can close it by clicking outsite or on this link: <a href="#"
                class="panel-close">close me</a>. You can put here anything, even another isolated view like in <a
                href="#" data-panel="right" class="panel-open">Right Panel</a></p>
          </div>
          <div class="block-title">Main View Navigation</div>
          <div class="list links-list">
            <ul>
              <li>
                <a href="/accordion/" class="panel-close">Accordion</a>
              </li>
              <li>
                <a href="/action-sheet/" class="panel-close">Action Sheet</a>
              </li>
              <li>
                <a href="/badge/" class="panel-close">Badge</a>
              </li>
              <li>
                <a href="/buttons/" class="panel-close">Buttons</a>
              </li>
              <li>
                <a href="/cards/" class="panel-close">Cards</a>
              </li>
              <li>
                <a href="/checkbox/" class="panel-close">Checkbox</a>
              </li>
              <li>
                <a href="/chips/" class="panel-close">Chips/Tags</a>
              </li>
              <li>
                <a href="/contacts-list/" class="panel-close">Contacts List</a>
              </li>
              <li>
                <a href="/data-table/" class="panel-close">Data Table</a>
              </li>
            </ul>
          </div>
          <div class="block">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse faucibus mauris leo, eu bibendum
              neque congue non. Ut leo mauris, eleifend eu commodo a, egestas ac urna. Maecenas in lacus faucibus,
              viverra ipsum pulvinar, molestie arcu. Etiam lacinia venenatis dignissim. Suspendisse non nisl semper
              tellus malesuada suscipit eu et eros. Nulla eu enim quis quam elementum vulputate. Mauris ornare consequat
              nunc viverra pellentesque. Aenean semper eu massa sit amet aliquam. Integer et neque sed libero mollis
              elementum at vitae ligula. Vestibulum pharetra sed libero sed porttitor. Suspendisse a faucibus lectus.
            </p>
            <p>Duis ut mauris sollicitudin, venenatis nisi sed, luctus ligula. Phasellus blandit nisl ut lorem semper
              pharetra. Nullam tortor nibh, suscipit in consequat vel, feugiat sed quam. Nam risus libero, auctor vel
              tristique ac, malesuada ut ante. Sed molestie, est in eleifend sagittis, leo tortor ullamcorper erat, at
              vulputate eros sapien nec libero. Mauris dapibus laoreet nibh quis bibendum. Fusce dolor sem, suscipit in
              iaculis id, pharetra at urna. Pellentesque tempor congue massa quis faucibus. Vestibulum nunc eros,
              convallis blandit dui sit amet, gravida adipiscing libero.</p>
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
    <div class="view view-main view-init safe-areas" data-master-detail-breakpoint="768" data-url="/"></div>
  </div>
  <script src="/assets/js/core.js"></script>
  <script src="/assets/js/routes.js"></script>
  <script src="/assets/js/store.js"></script>
  <script src="/assets/js/app.js"></script>
</body>

</html>
