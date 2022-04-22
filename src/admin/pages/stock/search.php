<template>
  <div class="page">
    <div class="navbar">
      <div class="navbar-bg"></div>
      <div class="navbar-inner">
        <div class="title">Поиск товара</div>
        <div class="right">
          <a class="link popover-open" href="#" data-popover=".popover-sort">
            <i class="f7-icons">sort_down</i>
          </a>
          <a class="link popover-open" href="#" data-popover=".popover-filters">
            <i class="f7-icons">funnel</i>
          </a>
          <a class="link popover-open" href="#" data-popover=".popover-categories">
            <i class="f7-icons">layers</i>
          </a>
        </div>
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
          <li 
            data-id="${item.id}"
            data-category="${item.info.category.id}"
            data-amount="${stockAmount(item.stock)}"
            data-price="${item.info.price}"
            data-photo="${(item.info.media[0] ? 0 : 1)}"
            data-description="${(item.info.description ? 0 : 1)}"
          >
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
      <!-- Popover's -->
      <div class="popover popover-sort">
        <div class="popover-inner">
          <div class="list">
            <ul>
              <li>
                <a @click="${()=> selectSort(null)}" class="list-button item-link popover-close text-color-red" href="#">
                  По умолчанию
                </a>
              </li>
              <li>
                <a @click="${()=> selectSort(1)}" class="list-button popover-close item-link" href="#">
                  Сначала дороже
                </a>
              </li>
              <li>
                <a @click="${()=> selectSort(2)}" class="list-button popover-close item-link" href="#">
                  Сначала дешевле
                </a>
              </li>
              <li>
                <a @click="${()=> selectSort(3)}" class="list-button popover-close item-link" href="#">
                  Больше в наличии
                </a>
              </li>
              <li>
                <a @click="${()=> selectSort(4)}" class="list-button popover-close item-link" href="#">
                  Меньше в наличии
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="popover popover-filters">
        <div class="popover-inner">
          <div class="list">
            <ul>
              <li>
                <a @click="${()=> selectFilter(null)}" class="list-button item-link popover-close text-color-red" href="#">
                  Не учитывать
                </a>
              </li>
              <li>
                <a @click="${()=> selectFilter(1)}" class="list-button popover-close item-link" href="#">
                  Есть в наличии
                </a>
              </li>
              <li>
                <a @click="${()=> selectFilter(2)}" class="list-button popover-close item-link" href="#">
                  Нет в наличии
                </a>
              </li>
              <li>
                <a @click="${()=> selectFilter(3)}" class="list-button popover-close item-link" href="#">
                  С фотографиями
                </a>
              </li>
              <li>
                <a @click="${()=> selectFilter(4)}" class="list-button popover-close item-link" href="#">
                  Без фотографий
                </a>
              </li>
              <li>
                <a @click="${()=> selectFilter(5)}" class="list-button popover-close item-link" href="#">
                  С описанием
                </a>
              </li>
              <li>
                <a @click="${()=> selectFilter(6)}" class="list-button popover-close item-link" href="#">
                  Без описания
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="popover popover-categories">
        <div class="popover-inner">
          <div class="list">
            <ul>
              <li>
                <a @click="${()=> selectCategory(null)}" class="list-button item-link popover-close text-color-red" href="#">
                  Не учитывать
                </a>
              </li>
              ${categories.value.map((category) => $h`
              <li>
                <a @click="${()=> selectCategory(category.id)}" class="list-button item-link popover-close" href="#">
                  (${category.id}) ${category.name}
                </a>
              </li>
              `)}
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
  .item-media {
    margin: auto;
  }

  .popover-categories .list{
    max-height: 75vh;
  }
  .popover-categories .item-link{
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
</style>
<script>
  export default (props, { $store, $f7, $on, $f7route }) => {
    clearList();
    var categories = $store.getters.categories;
    var items = $store.getters.items;
    var scannerId = app.utils.id();
    
    var searchbar = null;
    var searchSort = null;
    var searchFilter = ($f7route.query.filter ? +$f7route.query.filter : null);
    var searchCategory = null;

    function checkActiveFilter(el, value){
      if(value != null) $(el).addClass('text-color-red');
      else $(el).removeClass('text-color-red');
    }

    const selectSort = (id) => {
      searchSort = id;
      //Зажигаем подсветку кнопок фильтрации
      checkActiveFilter($('.popover-open[data-popover=".popover-sort"]'), id);
      renderList();
    }
    const selectFilter = (id) => {
      searchFilter = id;
      //Зажигаем подсветку кнопок фильтрации
      checkActiveFilter($('.popover-open[data-popover=".popover-filters"]'), id);
      renderList();
    }
    const selectCategory = (id) => {
      searchCategory = id;
      //Зажигаем подсветку кнопок фильтрации
      checkActiveFilter($('.popover-open[data-popover=".popover-categories"]'), id);
      renderList();
    }
    function clearList(el = '.stock-search-list'){
      $(el).find('li').html('');
    }
    function renderList(el = '.stock-search-list'){

      $(el).find('li').forEach((item, index) => {
        //Из-за hide/show, условие "вверх ногами". Истина == скрыть
        if(
          (searchCategory != null && (+$(item).attr('data-category') != searchCategory))
          ||
          //Есть в наличии
          (searchFilter == 1 && +$(item).attr('data-amount') == 0)
          ||
          //Нет в наличии
          (searchFilter == 2 && +$(item).attr('data-amount') > 0)
          ||
          //С фотографиями
          (searchFilter == 3 && +$(item).attr('data-photo') == 1)
          ||
          //Без фотографий
          (searchFilter == 4 && +$(item).attr('data-photo') == 0)
          ||
          //С описанием
          (searchFilter == 5 && +$(item).attr('data-description') == 1)
          ||
          //Без описания
          (searchFilter == 6 && +$(item).attr('data-description') == 0)
        ){
          $(item).hide();
        }
        else {
          $(item).show();
        }

        var sortList = $(el).find('li').sort(
          function(a, b){
            //По умолчанию (по id)
            if(searchSort == null){
              a = +$(a).attr('data-id');
              b = +$(b).attr('data-id');
              return (a > b ? 1 : (a == b ? 0 : -1));
            }
            //Дороже
            if(searchSort == 1){
              a = +$(a).attr('data-price');
              b = +$(b).attr('data-price');
              return (a < b ? 1 : (a == b ? 0 : -1));
            }
            //Дешевле
            if(searchSort == 2){
              a = +$(a).attr('data-price');
              b = +$(b).attr('data-price');
              return (a > b ? 1 : (a == b ? 0 : -1));
            }
            //Больше в наличии
            if(searchSort == 3){
              a = +$(a).attr('data-amount');
              b = +$(b).attr('data-amount');
              return (a < b ? 1 : (a == b ? 0 : -1));
            }
            //Меньше в наличии
            if(searchSort == 4){
              a = +$(a).attr('data-amount');
              b = +$(b).attr('data-amount');
              return (a > b ? 1 : (a == b ? 0 : -1));
            }
          }
        );
        $(el).find('ul').append(sortList);
      });

    }

    const stockAmount = (list) => {
      let amount = 0;
      Object.keys(list).forEach(function(key) {
        amount += list[key].count;
      });
      return amount;
    }

    $on('pageInit', () => {
      scannerFocusEl = $(document).find('.scanner-input-' + scannerId);

      //Зажигаем подсветку кнопок фильтрации, если фильтры заранее включены
      checkActiveFilter($('.popover-open[data-popover=".popover-sort"]'), searchSort);
      checkActiveFilter($('.popover-open[data-popover=".popover-filters"]'), searchFilter);
      checkActiveFilter($('.popover-open[data-popover=".popover-categories"]'), searchCategory);

      searchbar = $f7.searchbar.create({
        el: '.searchbar',
        searchContainer: '.stock-search-list',
        searchIn: '.item-title, .item-subtitle',
        on: {
          search(sb, query, previousQuery) {
            console.log(query, previousQuery);
          }
        }
      });
      setTimeout(function() {
        renderList();
      }, 200);
    });
    $on('pageAfterIn', () => {
      renderList();
    });
    $on('pageBeforeRemove', () => {
      searchbar.destroy();
    });

    return $render;
  }
</script>