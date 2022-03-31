<template>
  <div class="page">
    <div class="navbar">
      <div class="navbar-bg"></div>
      <div class="navbar-inner sliding">
        <div class="title">Поиск товара (800 шт)</div>
        <div class="subnavbar">
          <form data-search-container=".virtual-list" data-search-item="li" data-search-in=".item-title"
            class="searchbar searchbar-init">
            <div class="searchbar-inner">
              <div class="searchbar-input-wrap">
                <input type="search" placeholder="Поиск по названию или артикулу" />
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
          <li>Nothing found</li>
        </ul>
      </div>
      <div class="list virtual-list media-list searchbar-found"></div>
    </div>
  </div>
</template>
<script>
  export default (props, { $f7, $el, $theme, $on }) => {
    let items = [];
    for (let i = 1; i <= 10000; i++) {
      items.push({
        title: 'Название ' + i,
        subtitle: 'Артикул ' + i
      });
    }
    $on('pageInit', () => {
      const virtualList = $f7.virtualList.create({
        // List Element
        el: $el.value.find('.virtual-list'),
        // Pass array with items
        items,
        // Custom search function for searchbar
        searchAll: function (query, items) {
          var found = [];
          for (var i = 0; i < items.length; i++) {
            if (items[i].title.toLowerCase().indexOf(query.toLowerCase()) >= 0 || query.trim() === '') found.push(i);
          }
          return found; //return array with mathced indexes
        },
        // List item render
        renderItem(item) {
          return `
          <li>
            <a href="#" class="item-link item-content">
              <div class="item-media"><img src="https://cdn.framework7.io/placeholder/people-160x160-2.jpg"
                  width="80" /></div>
              <div class="item-inner">
                <div class="item-title-row">
                  <div class="item-title">${item.title}</div>
                  <div class="item-after">8 000 руб</div>
                </div>
                <div class="item-subtitle">${item.subtitle}</div>
                <div class="item-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sagittis
                  tellus ut turpis condimentum, ut dignissim lacus tincidunt. Cras dolor metus, ultrices condimentum
                  sodales sit amet, pharetra sodales eros. Phasellus vel felis tellus. Mauris rutrum ligula nec
                  dapibus feugiat. In vel dui laoreet, commodo augue id, pulvinar lacus.</div>
              </div>
            </a>
          </li>`;
        },
        // Item height
        height: $theme.ios ? 63 : ($theme.md ? 73 : 77),
      });
    });

    return $render;
  }
</script>