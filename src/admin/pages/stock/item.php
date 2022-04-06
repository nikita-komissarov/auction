<template>
  <div class="page">
    <div class="navbar">
      <div class="navbar-bg"></div>
      <div class="navbar-inner sliding">
        <div class="left">
          <a class="link back">
            <i class="icon icon-back"></i>
            <span class="if-not-md">Назад</span>
          </a>
        </div>
        <div class="title">Товар #${props.id}</div>
        <div class="right">
          <a href="#" class="link"><i class="f7-icons">pencil_circle</i></a>
          <a href="#" class="link"><i class="f7-icons">shippingbox</i></a>
          <a href="#" class="link"><i class="f7-icons">cart_badge_plus</i></a>
        </div>
      </div>
    </div>
    <div class="searchbar-backdrop"></div>
    <div class="page-content">
      <div class="block-title">Основная информация</div>
      <div class="list inset">
        <ul>
          <li class="item item-content">
            <div class="item-inner">
              <div class="item-title">
                <div class="item-header">Артикул</div>
                ${items.value[item_id].info.article}
              </div>
            </div>
          </li>
          <li class="item item-content">
            <div class="item-inner">
              <div class="item-title">
                <div class="item-header">Название</div>
                ${items.value[item_id].info.name}
              </div>
            </div>
          </li>
          <li class="item item-content">
            <div class="item-inner">
              <div class="item-title">
                <div class="item-header">Стоимость выкупа и продажи в розницу</div>
                ${items.value[item_id].info.price} руб
              </div>
            </div>
          </li>
          <li>
            <a href="${items.value[item_id].info.market}" class="item-link item-content">
              <div class="item-inner">
                <div class="item-title">
                  Ссылка на страницу из магазина
                </div>
              </div>
            </a>
          </li>
          <li class="item item-content">
            <div class="item-inner">
              <div class="item-title">
                <div class="item-header">Категория</div>
                ${items.value[item_id].info.category.name}
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="block-title">Описание</div>
      <div class="block block-strong inset">
        ${items.value[item_id].info.description}
      </div>
      <div class="block-title">Наличие на складах</div>
      <div class="list inset">
        <ul id="stocks">
          ${stocks.value.map((stock) => $h`
          <li id="stock-${stock.id}" data-id="${stock.id}" class="item-content">
            <div class="item-inner">
              <div class="item-title">
                <div class="item-header">${stock.name}</div>
                <a href="#" data-id="${stock.id}" class="stock-rack">${items.value[item_id].stock[stock.id].rack}</a> <b>-</b> <a href="#" data-id="${stock.id}" class="stock-cell">${items.value[item_id].stock[stock.id].cell}</a>
                <div class="item-footer">${stock.address}</div>
              </div>
              <div class="item-after">
                <div class="stepper stepper-init">
                  <div data-val="-1" class="stock-count-btn stepper-button-minus"></div>
                  <div class="stepper-input-wrap">
                    <input class="stock-count" type="text" value="${items.value[item_id].stock[stock.id].count}" min="0" step="1" readonly />
                  </div>
                  <div data-val="1" class="stock-count-btn stepper-button-plus"></div>
                </div>
              </div>
            </div>
          </li>
          `)}
        </ul>
      </div>
      <div class="list inset">
        <ul>
          <li><a class="list-button" href="/stock/item/media/${props.id}/">Добавить товар</a></li>
        </ul>
      </div>
    </div>
  </div>
</template>
<style>
  .dialog-input {
    text-transform: uppercase !important;
  }
</style>
<script>
  export default (props, { $store, $f7, $el, $theme, $on, $update }) => {
    var stocks = $store.getters.stocks;
    var items = $store.getters.items;
    var item_id = items.value.findIndex(el => el.id == props.id);
    //

    console.log("props", props);
    console.log("stocks", stocks);
    console.log("items", items);
    console.log("item_id", item_id);

    $on('pageInit', (e, page) => {

      $(page.el).find('.stock-count-btn').on('click', function() {
        let li = $(this).closest('li');
        let stock = +$(li).attr('data-id');
        let count = +$(li).find('.stock-count').val();
        let val = +$(this).attr('data-val');

        if((count + val) < 0) return $f7.dialog.alert('Количество товара на складе не может быть меньше нуля');
        $(li).find('.stock-count-btn').addClass('disabled');
        $f7.request({
          url: '/server/proc/stock/count.php',
          method: 'POST',
          dataType: 'json',
          data: {
            item: props.id,
            stock: stock,
            val: val,
          },
          success: function (data) {
            $f7.dialog.close();
            if(data != (count + val)) {
              $f7.dialog.alert('<b>Внимание!</b> Кто-то параллельно с Вами изменяет количество этого товара на этом же складе');
            }
            $(li).find('.stock-count').val(data);
            $(li).find('.stock-count-btn').removeClass('disabled');
          },
          error: function (data) {
            $f7.dialog.close();
            $f7.dialog.alert('Ошибка изменения ячейки');
          }
        });
      });

      function saveStock(id, rack, cell){
        $f7.dialog.preloader('Изменение ячейки...');
        $f7.request({
          url: '/server/proc/stock/place.php',
          method: 'POST',
          dataType: 'json',
          data: {
            item: props.id,
            stock: id,
            rack: rack,
            cell: cell,
          },
          success: function (data) {
            $f7.dialog.close();

            if(rack) $('#stock-' + id).find('.stock-rack').html(rack);
            if(cell) $('#stock-' + id).find('.stock-cell').html(cell);
          },
          error: function (data) {
            $f7.dialog.close();
            $f7.dialog.alert('Ошибка изменения ячейки');
          }
        });
      }

      $(page.el).find('.stock-rack').on('click', function(event) {
        event.preventDefault();


        let stock = $(this).closest('li');
        $f7.dialog.prompt(
          'Укажите стеллаж в формате "ABCD" буквами латинского алфавита',
          $(stock).find('.item-header').html(),
          function (rack) {
            let test = /^[a-zA-Z]+$/.test(rack);
            if(!test) {
              return $f7.dialog.alert('Используйте только буквы латинского алфавита<br><br><b>Изменения не применены</b>');
            }
            if(rack.length != 4){
              return $f7.dialog.alert('Введите 4 буквы в формате "ABCD"<br><br><b>Изменения не применены</b>');
            }
            rack = rack.toUpperCase();
            saveStock($(stock).attr('data-id'), rack, null);
          },
          function () {},
          $(stock).find('.stock-rack').html(),
          );
      });

      $(page.el).find('.stock-cell').on('click', function(event) {
        event.preventDefault();


        let stock = $(this).closest('li');
        $f7.dialog.prompt(
          'Укажите ячейку числом с 0 по 1000',
          $(stock).find('.item-header').html(),
          function (cell) {
            let test = /^[0-9]+$/.test(cell);
            if(!test) {
              return $f7.dialog.alert('Используйте только цифры<br><br><b>Изменения не применены</b>');
            }
            cell = +cell;
            if(cell < 0 || cell > 1000) return $f7.dialog.alert('Введите число с 0 по 1000<br><br><b>Изменения не применены</b>');
            saveStock($(stock).attr('data-id'), null, cell);
          },
          function () {},
          +$(stock).find('.stock-cell').html(),
          );
      });
    });

    return $render;
  }
</script>