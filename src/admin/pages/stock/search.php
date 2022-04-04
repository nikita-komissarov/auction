<template>
  <div class="page">
    <div class="navbar">
      <div class="navbar-bg"></div>
      <div class="navbar-inner sliding">
        <div class="title">Поиск товара</div>
        <div class="subnavbar">
          <form data-search-container=".virtual-list" data-search-item="li" data-search-in=".item-title"
            class="searchbar searchbar-init">
            <div class="searchbar-inner">
              <div class="searchbar-input-wrap">
                <input class="scanner-input-${scannerId}" type="search" placeholder="Поиск по названию или артикулу" />
                <i class="searchbar-icon"></i>
                <span class="input-clear-button"></span>
              </div>
              <span class="searchbar-disable-button if-not-aurora">Отменить</span>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="searchbar-backdrop"></div>
    <div class="page-content">
      <div class="list simple-list searchbar-not-found">
        <ul>
          <li>Совпадений не найдено</li>
        </ul>
      </div>
      <div class="list virtual-list media-list searchbar-found"></div>
    </div>
  </div>
</template>
<script>
  export default (props, { $f7, $el, $theme, $on, $update }) => {

    var scannerId = app.utils.id();
    $on('pageInit', (e, page) => { 

      scannerFocusEl = $(document).find('.scanner-input-' + scannerId);

      $f7.request({
        url: '/server/proc/stock/list.php',
        method: 'GET',
        dataType: 'json',
        success: function (items) {
          console.log("items", items);
          const virtualList = $f7.virtualList.create({
            // List Element
            el: $el.value.find('.virtual-list'),
            // Pass array with items
            items,
            // Custom search function for searchbar
            searchAll: function (query, items) {
              var found = [];
              for (var i = 0; i < items.length; i++) {
                if(items[i].name.toLowerCase().indexOf(query.toLowerCase()) >= 0 || query.trim() === '') found.push(i);
                if(items[i].article.toLowerCase().indexOf(query.toLowerCase()) >= 0 || query.trim() === '') found.push(i);
                //if(items[i].category.name.toLowerCase().indexOf(query.toLowerCase()) >= 0 || query.trim() === '') found.push(i);
                //if(items[i].price.toLowerCase().indexOf(query.toLowerCase()) >= 0 || query.trim() === '') found.push(i);
              }
              return found; //return array with mathced indexes
            },
            // List item render
            renderItem(item) {
              console.log("item", item);
              return `
              <li>
                <a href="/stock/item/${item.id}/" class="item-link item-content">
                  <div class="item-media"><img src="https://cdn.framework7.io/placeholder/people-160x160-2.jpg"
                      width="80" /></div>
                  <div class="item-inner">
                    <div class="item-title-row">
                      <div class="item-title">${item.name}</div>
                      <div class="item-after">${item.price} руб</div>
                    </div>
                    <div class="item-subtitle">${item.article}</div>
                    <div class="item-text">${item.category.name}<br>${item.count} шт</div>
                  </div>
                </a>
              </li>`;
            },
            // Item height
            height: 106.8,
          });
        },
        error: function (data) {
        }
      });
    });

    return $render;
  }
</script>