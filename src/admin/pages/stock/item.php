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
      </div>
    </div>
    <div class="searchbar-backdrop"></div>
    <div class="page-content">
      <div class="block-title display-flex align-items-center justify-content-space-between">
        Фотографии
        <a href="/stock/item/media/${props.id}/">
          <i class="f7-icons">pencil_circle</i>
        </a>
      </div>
      ${items.value[item_id].info.media[0] && $h ? $h `
      <div class="block block-strong inset no-margin-bottom">
        <div class="row align-items-flex-end">
          <div class="col-20 photo">
            <img class="elevation-3 elevation-hover-5" data-id="0" src="${items.value[item_id].info.media[0]}" />
          </div>
          <div class="col-20 photo">
            <img class="elevation-3 elevation-hover-5" data-id="1" src="${items.value[item_id].info.media[1]}" />
          </div>
          <div class="col-20 photo">
            <img class="elevation-3 elevation-hover-5" data-id="2" src="${items.value[item_id].info.media[2]}" />
          </div>
          <div class="col-20 photo">
            <img class="elevation-3 elevation-hover-5" data-id="3" src="${items.value[item_id].info.media[3]}" />
          </div>
          <div class="col-20 photo">
            <img class="elevation-3 elevation-hover-5" data-id="4" src="${items.value[item_id].info.media[4]}" />
          </div>
        </div>
      </div>
      ` : $h `
      <div class="list inset">
        <ul>
          <li><a class="list-button text-color-red" href="/stock/item/media/${props.id}/">У товара нет фотографий</a></li>
        </ul>
      </div>
      `}
      <div class="block-title display-flex align-items-center justify-content-space-between">
        Основная информация
        <a href="#"><i class="f7-icons">pencil_circle</i></a>
      </div>
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
                ${bitsOfNum(items.value[item_id].info.price, 2)} руб
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
      <div class="list inset">
        <ul>
          <li><a class="list-button" href="/stock/item/media/${props.id}/">Выставить на аукцион</a></li>
          <li><a class="list-button" href="/stock/item/media/${props.id}/">Добавить в корзину</a></li>
        </ul>
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
                <div class="segmented">
                  <button data-type="minus" class="button button-outline stock-count-change-btn">-</button>
                  <button class="button button-outline stock-count-btn padding-horizontal">${items.value[item_id].stock[stock.id].count} / 0</button>
                  <button data-type="plus" class="button button-outline stock-count-change-btn">+</button>
                </div>
              </div>
            </div>
          </li>
          `)}
        </ul>
      </div>
      <div class="block-title display-flex align-items-center justify-content-space-between">
        Описание
        <a href="#"><i class="f7-icons">pencil_circle</i></a>
      </div>
      ${items.value[item_id].info.description && $h ? $h`
      <div class="block block-strong inset">
        <div class="description-block" innerHTML="${items.value[item_id].info.description}"></div>
      </div>
      ` : $h `
      <div class="list inset">
        <ul>
          <li><a class="list-button text-color-red" href="/stock/item/media/${props.id}/">У товара нет описания</a></li>
        </ul>
      </div>
      `}
    </div>
  </div>
</template>
<style>
/*   .dialog-input {
    text-transform: uppercase !important;
  } */
  .photo > img {
    width: 12.5vw;
    height: 12.5vw;
    cursor: pointer;
    object-fit: cover;
  }
  .stock-count-btn {
    min-width: 5rem !important;
  }
  .description-block table {
    width: 100%;
  }
  .description-block table td {
    width: 50%;
  }
  .description-block h1:first-child
  .description-block h2:first-child,
  .description-block h3:first-child,
  .description-block h4:first-child,
  .description-block h5:first-child,
  .description-block h6:first-child {
    margin-top: 0;
  }
</style>
<script>
  export default (props, { $store, $f7, $el, $theme, $on, $update }) => {
    var stocks = $store.getters.stocks;
    var items = $store.getters.items;
    var item_id = items.value.findIndex(el => el.id == props.id);
    var photoBrowser;
    //

    console.log("props", props);
    console.log("stocks", stocks);
    console.log("items", items);
    console.log("item_id", item_id);

    $on('pageReinit', (e, page) => {
      //Перезаписываем фотографии при переинициализации
      //(В случае изменения фото и возврата назад)
      photoBrowser.params.photos = items.value[item_id].info.media;
    });

    $on('pageInit', (e, page) => {
      photoBrowser = $f7.photoBrowser.create({
        photos: items.value[item_id].info.media,
        type: 'page',
        pageBackLinkText: 'Назад',
        navbarOfText: 'из'
      });
      $('.photo').on('click', function () {
        photoBrowser.open(+$(this).find('img').attr('data-id'));
      });

      $(page.el).find('.stock-count-change-btn').on('click', function() {
        let li = $(this).closest('li');
        let stock = +$(li).attr('data-id');
        let count = +$(li).find('.stock-count').val();
        let val = +$(this).attr('data-val');
        let type = ($(this).attr('data-type') == 'plus' ? 'plus' : 'minus');

        if(type == 'plus'){
          let dialog = $f7.dialog.prompt(
            'Укажите количество',
            'Добавление товара',
            function (amount) {
              if(amount <= 0) return $f7.dialog.alert('Количество должно быть больше нуля');
              console.log(amount);
              let dialog = $f7.dialog.prompt(
                'Укажите закупочную стоимость одной единицы товара',
                'Добавление товара',
                function (price) {
                  console.log(price);
                  var dialog = app.dialog.create({
                    title: 'Подтвердите ввод',
                    text: `
                      <table style="text-align: left; width: 100%;">
                        <tr>
                          <td>
                            <b>Место:</b>
                          </td>
                          <td>
                            'Основной склад'
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <b>Количество:</b>
                          </td>
                          <td>
                            ${amount} ${declOfNum(amount, ['штука','штуки','штук'])}
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <b>Стоимость:</b>
                          </td>
                          <td>
                            ${bitsOfNum(price * amount, 2)} руб
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <b>Цена за шт:</b>
                          </td>
                          <td>
                            ${bitsOfNum(price, 2)} руб
                          </td>
                        </tr>
                      </table>
                    `,
                    buttons: [
                      {
                        text: 'Отменить',
                      },
                      {
                        text: 'Подтвердить',
                        onClick: function(dialog, e) {
                          $(li).find('input').click(); 
                        },
                      },
                    ],
                  }).open();
                },
                function () {},
                $(stock).find('.stock-rack').html(),
              ).once('opened', function(event){
                let el = event.el;
                $(el).find('input')
                  .attr('type', 'number')
                  .attr('min', '1')
                  .attr('placeholder', 'Закупочная стоимость');
                console.log("el", el);
              });
            },
            function () {},
            $(stock).find('.stock-rack').html(),
          ).once('opened', function(event){
            let el = event.el;
            $(el).find('input')
              .attr('type', 'number')
              .attr('min', '1')
              .attr('placeholder', 'Количество');
            console.log("el", el);
          });
        }
        else {
          $f7.dialog.prompt(
            'Отсканируйте внутренний артикул',
            'Удаление товара',
            function (input) {
              let test = /^[0-9]+$/.test(input);
              if(!test) {
                return $f7.dialog.alert('Используйте только цифры<br><br><b>Изменения не применены</b>');
              }
            },
            function () {},
            $(stock).find('.stock-rack').html(),
          );
        }
        return true;
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