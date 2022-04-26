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
          <a href="#" class="stock-add-entry" data-item-id="${props.id}">
            <i class="f7-icons">plus</i>
          </a>
          <a href="#" class="stock-entry-list" data-item-id="${props.id}">
            <i class="f7-icons">minus</i>
          </a>
        </div>
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
    var popupList;
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

      $(page.navbarEl).find('.stock-entry-list').on('click', function() {
        let item_id = +$(this).attr('data-item-id').trim();
        $f7.dialog.preloader('Загрузка списка...');
        $f7.request({
          url: '/server/proc/stock/entry/list.php',
          method: 'POST',
          dataType: 'json',
          data: {
            item: item_id,
          },
          success: function (data) {
            console.log("data", data);
            $f7.dialog.close();
            let list = '';
            data.forEach((entry, index) => {
              list += `
                <li>
                  <a href="#" class="item-link item-content" data-id="${entry.id}">
                    <div class="item-inner">
                      <div class="item-title">
                        <span class="article text-color-red">${entry.article}</span>.${entry.id}
                        <div class="item-footer">${entry.price} руб, ${moment.unix(entry.create_time).format('DD.MM.YYYY, HH:MM:ss')}</div>
                      </div>
                      <div class="item-after">Печать</div>
                    </div>
                  </a>
                </li>
              `;
              console.log("entry", entry);
            });
            popupList = $f7.popup.create({
              content: `
                <div class="popup" style="overflow: auto;">
                  <div class="list no-margin">
                    <ul>
                      ${list}
                    </ul>
                  </div>
                </div>
              `,
              // Events
              on: {
                open: function (popup) {
                  console.log("popup", );
                  $(popup.el).find('a').on('click', function(){
                    let el = $(this);
                    let id = +$(this).attr('data-id');
                    console.log("id", id);
                    $f7.dialog.preloader('Генерация этикетки...');
                    $f7.request({
                      url: '/server/proc/stock/entry/label.php',
                      method: 'POST',
                      dataType: 'text',
                      data: {
                        entry: id,
                      },
                      success: function (data) {
                        function PrintElem(data)
                        {
                          var wnd = window.open('', 'PRINT', 'height=600,width=800');

                          wnd.document.write('<html><head><title>' + document.title  + '</title>');
                          wnd.document.write('</head><body >');
                          wnd.document.write(data);
                          wnd.document.write('</body></html>');

                          wnd.document.close();
                          wnd.focus();
                          wnd.print();
                          wnd.close();

                          return true;
                        }
                        $f7.dialog.close();
                        $(el).find('.article').removeClass('text-color-red').addClass('text-color-green');
                        PrintElem(data);
                      },
                      error: function (data) {
                        $f7.dialog.close();
                        $f7.dialog.alert('Ошибка изменения ячейки');
                      }
                    });
                  });
                  console.log('Popup open');
                },
              }
            }).open();
          },
          error: function (data) {
            $f7.dialog.close();
            $f7.dialog.alert('Ошибка добавления товара');
          }
        });
      });
      $(page.navbarEl).find('.stock-add-entry').on('click', function() {
        let item_id = +$(this).attr('data-item-id').trim();
        let dialog = $f7.dialog.prompt(
          'Укажите количество',
          'Добавление товара',
          function (amount) {
            if(amount <= 0) return $f7.dialog.alert('Количество должно быть больше нуля');
            if(amount > 500) return $f7.dialog.alert('Не более 500 штук за один раз');
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
                          <b>Количество:</b>
                        </td>
                        <td>
                          ${amount} ${declOfNum(amount, ['штука','штуки','штук'])}
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
                      <tr>
                        <td>
                          <b>Стоимость:</b>
                        </td>
                        <td>
                          ${bitsOfNum(price * amount, 2)} руб
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
                        $f7.dialog.preloader('Добавление товара...');
                        $f7.request({
                          url: '/server/proc/stock/entry/add.php',
                          method: 'POST',
                          dataType: 'json',
                          data: {
                            item: item_id,
                            price: price,
                            amount: amount,
                          },
                          success: function (data) {
                            $f7.dialog.close();

                          },
                          error: function (data) {
                            $f7.dialog.close();
                            $f7.dialog.alert('Ошибка добавления товара');
                          }
                        });
                      },
                    },
                  ],
                }).open();
              },
            ).once('opened', function(event){
              let el = event.el;
              $(el).find('input')
                .attr('type', 'number')
                .attr('min', '1')
                .attr('placeholder', 'Закупочная стоимость');
              console.log("el", el);
            });
          },
        ).once('opened', function(event){
          let el = event.el;
          $(el).find('input')
            .attr('type', 'number')
            .attr('min', '1')
            .attr('placeholder', 'Количество');
          console.log("el", el);
        });
      });

      $(page.el).find('.stock-count-change-btn').on('click', function() {
        let li = $(this).closest('li');
        let stock = +$(li).attr('data-id');
        let count = +$(li).find('.stock-count').val();
        let val = +$(this).attr('data-val');
        let type = ($(this).attr('data-type') == 'plus' ? 'plus' : 'minus');

        if(type == 'plus'){
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