<template>
  <div class="page">
    <div class="navbar">
      <div class="navbar-bg"></div>
      <div class="navbar-inner">
        <div class="title">Поиск товара</div>
        <div class="subnavbar">
          <form class="searchbar">
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
    <div class="page-content">
      <div class="searchbar-backdrop"></div>
      <div class="list stock-search-list media-list searchbar-found">
        <ul>
        ${items.value.map((item) => $h`
          <li>
            <a href="/stock/item/${item.id}/" class="item-link item-content">
              <div class="item-media"><img src="${(item.info.media[0] ? item.info.media[0] : '/assets/img/no-camera.svg')}"
                  width="65" /></div>
              <div class="item-inner">
                <div class="item-title-row">
                  <div class="item-title">${item.info.name}</div>
                  <div class="item-after">${bitsOfNum(item.info.price, 2)} руб</div>
                </div>
                <div class="item-subtitle">Арт. ${item.info.article}</div>
                ${stockAmount(item.stock) > 0 && $h ? $h`
                <div class="item-text">В наличии ${stockAmount(item.stock)} ${declOfNum(stockAmount(item.stock), ['штука','штуки','штук'])}</div>
                ` : $h`
                <div class="item-text text-color-red">Нет в наличии</div>
                `}
              </div>
            </a>
          </li>
        `)}
        </ul>
      </div>
      <div class="block searchbar-not-found">
        <div class="block-inner">Nothing found</div>
      </div>
    </div>
  </div>
</template>
<style>
  .item-media {
    margin: auto;
  }
</style>
<script>
  export default (props, { $store, $f7, $on }) => {
    var items = $store.getters.items;
    var scannerId = app.utils.id();

    const stockAmount = (list) => {
      let amount = 0;
      Object.keys(list).forEach(function(key) {
        amount += list[key].count;
      });
      return amount;
    }

    $on('pageInit', () => {
      scannerFocusEl = $(document).find('.scanner-input-' + scannerId);
      // create searchbar
      var searchbar = $f7.searchbar.create({
        el: '.searchbar',
        searchContainer: '.stock-search-list',
        searchIn: '.item-title, .item-subtitle',
        on: {
          search(sb, query, previousQuery) {
            console.log(query, previousQuery);
          }
        }
      });
    })

    return $render;
  }
</script>