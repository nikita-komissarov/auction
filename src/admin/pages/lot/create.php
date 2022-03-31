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
        <div class="title">Создание нового лота</div>
      </div>
    </div>
    <div class="page-content">
      <form id="form-lot-create">
        <div class="block-title block-title-medium">Опции лота</div>
        <div class="list inset simple-list">
          <ul>
            <li>
              <span>Возможность выкупа</span>
              <label class="toggle toggle-init">
                <input id="options-redemption" type="checkbox" checked/>
                <span class="toggle-icon"></span>
              </label>
            </li>
            <li>
              <span>Комиссия аукциона</span>
              <label class="toggle toggle-init">
                <input id="options-commission" type="checkbox" checked />
                <span class="toggle-icon"></span>
              </label>
            </li>
            <li>
              <span>Несколько товаров</span>
              <label class="toggle toggle-init">
                <input id="options-mystery" type="checkbox" />
                <span class="toggle-icon"></span>
              </label>
            </li>
            <li>
              <span>Mystery Box</span>
              <label class="toggle toggle-init">
                <input id="options-mystery" type="checkbox" />
                <span class="toggle-icon"></span>
              </label>
            </li>
          </ul>
        </div>
        <div class="block-title block-title-medium">Фотографии</div>
        <div class="list media-list inset sortable sort-media">
          <ul id="media-objects-box"></ul>
        </div>
        <div class="block-title block-title-medium">Информация о товаре</div>
        <div class="list inset">
          <ul>
            <li>
              <a class="item-link smart-select smart-select-init" data-open-in="popover">
                <select id="info-type">
                  <option value="1" selected>Новый</option>
                  <option value="2">Бывший в употреблении</option>
                </select>
                <div class="item-content">
                  <div class="item-inner">
                    <div class="item-title">Состояние товара</div>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a class="item-link item-content" href="#" id="info-category">
                <input type="hidden" />
                <div class="item-inner">
                  <div class="item-title">Категория</div>
                  <div class="item-after"></div>
                </div>
              </a>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Название</div>
                <div class="item-input-wrap">
                  <input id="info-name" type="text" placeholder="Название" value="Название товара" />
                  <span class="input-clear-button"></span>
                </div>
              </div>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Город продажи</div>
                <div class="item-input-wrap">
                  <input id="info-city" type="text" placeholder="Начните вводить название города" value="Нижний Новгород" />
                </div>
              </div>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Адрес самовывоза</div>
                <div class="item-input-wrap">
                  <input id="info-address" type="text" placeholder="Начните вводить адрес" value="Нижний Новгород, проспект Гагарина, дом 1" />
                </div>
              </div>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Среднерыночная стоимость</div>
                <div class="item-input-wrap">
                  <input id="info-average" type="number" placeholder="2500" value="2500"/>
                  <span class="input-clear-button"></span>
                </div>
              </div>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Ссылка на страницу из магазина</div>
                <div class="item-input-wrap">
                  <input id="info-market" type="text" placeholder="https://market.yandex.ru/" value="https://market.yandex.ru/product--smartfon-apple-iphone-11/558171067" />
                  <span class="input-clear-button"></span>
                </div>
              </div>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Ссылка на страницу с описанием</div>
                <div class="item-input-wrap">
                  <input id="info-desc" type="text" placeholder="https://docs.google.com/document/d/" value="https://docs.google.com/document/d/1DqBxOWbOF7Z2LW53gfVgU6WWDlxt6P0dzpNBB5TwQfw" />
                  <span class="input-clear-button"></span>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="block-title block-title-medium">Настройка торгов</div>
        <div class="list inset">
          <ul>
            <li>
              <div class="item-content item-input">
                <div class="item-inner">
                  <div class="item-title item-label">Дата и время начала</div>
                  <div class="item-input-wrap">
                    <input id="bidding-date" type="text" placeholder="Выберите дату и время начала торгов" readonly="readonly" value="29.03.2022, 02:00" />
                  </div>
                </div>
              </div>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Стартовая цена</div>
                <div class="item-input-wrap">
                  <input id="bidding-price" type="number" placeholder="1000" value="1000" />
                  <span class="input-clear-button"></span>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="list inset">
          <ul>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Цена выкупа</div>
                <div class="item-input-wrap">
                  <input id="bidding-redemption" type="number" placeholder="5000" value="5000" />
                  <span class="input-clear-button"></span>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="list inset">
          <ul>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Комиссия аукциона в рублях</div>
                <div class="item-input-wrap">
                  <input id="bidding-commission" type="number" placeholder="10" value="15" />
                  <span class="input-clear-button"></span>
                </div>
              </div>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Логин продавца в Telegram</div>
                <div class="item-input-wrap">
                  <input id="bidding-seller" type="text" placeholder="Nikita_Komissarov" value="Nikita_Komissarov" />
                  <span class="input-clear-button"></span>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="list inset">
          <ul>
            <li><a class="list-button" id="button-lot-create">Создать лот</a></li>
          </ul>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  export default (props, { $, $f7, $on }) => {
    let date = new Date();
    let categories;
    let autocompleteCategories;

    let calendarDate;

    let autocompleteCity;
    let autocompleteAddress;
    let autocompleteCityAjax = app.request.abortController();;
    let autocompleteAddressAjax = app.request.abortController();;

    let media = [];

    $on('pageInit', () => {
      app.sortable.enable('.sort-media');

      $('#button-lot-create').on('click', function() {
        let data = new Object();

        data.info = {
          type: +getVal($('#info-type')),
          category: autocompleteCategories.value[0],
          name: getVal($('#info-name')),
          city: getVal($('#info-city')),
          address: getVal($('#info-address')),
          average: getVal($('#info-average')),
          market: getVal($('#info-market')),
          desc: getVal($('#info-desc')),
        };
        data.options = {
          redemption: $('#options-redemption').is(":checked"),
          commission: $('#options-commission').is(":checked"),
        };
        data.bidding = {
          date: getVal($('#bidding-date')),
          price: +getVal($('#bidding-price')),
          redemption: +getVal($('#bidding-redemption')),
          commission: +getVal($('#bidding-commission')),
          seller: getVal($('#bidding-seller')),
        };
        data.media = media;

console.log("data", data);
        if(data.media.length == 1) return $f7.dialog.alert('Добавьте хотя бы один медиафайл');
        if(!data.info.category) return $f7.dialog.alert('Укажите категорию');
        if(!data.info.name.length) return $f7.dialog.alert('Укажите название');
        if(!data.info.city.length) return $f7.dialog.alert('Укажите город');
        if(!data.info.address.length) return $f7.dialog.alert('Укажите адрес самовывоза');

        if(!data.bidding.date.length) return $f7.dialog.alert('Укажите дату и время начала торгов');

        if(data.options.redemption) {
          if(data.bidding.redemption <= 0) return $f7.dialog.alert('Укажите цену выкупа или отключите выкуп лота');
          if(data.bidding.price >= data.bidding.redemption) return $f7.dialog.alert('Цена выкупа должна быть больше стартовой цены');
        }

        if(data.options.commission) {
          if(data.bidding.commission < 0) return $f7.dialog.alert('Комиссия аукциона должна быть больше или равна нулю');
          if(!data.bidding.seller.length) return $f7.dialog.alert('Укажите Telegram логин продавца или отключите комиссию');
          if(data.bidding.seller.charAt(0) == '@') return $f7.dialog.alert('Telegram логин продавца <b>не</b> должен начинаться с "@"');
        }

        function isValidHttpUrl(string) {
          let url;
          try {
            url = new URL(string);
          } catch (_) {
            return false;
          }
          return url.protocol === "http:" || url.protocol === "https:";
        }
        if(!isValidHttpUrl(data.info.market)) return $f7.dialog.alert('Ссылка на <b>страницу в магазине</b> не является правильной');
        if(!isValidHttpUrl(data.info.desc)) return $f7.dialog.alert('Ссылка на <b>страницу с описанием</b> не является правильной');

        let mediaDuplicate = false;
        data.media.forEach((comparable, comparableIndex) => {
          data.media.forEach((compared, comparedIndex) => {
            //Если разный индекс
            if(comparableIndex != comparedIndex){
              //Если одинаковое время последнего изменения
              if(comparable.lastModified == compared.lastModified){
                //Если одинаковый размер
                if(comparable.size == compared.size){
                  //Значит это дубль?
                  mediaDuplicate = true;
                }
              }
            }
          });
        });
        if(mediaDuplicate) return $f7.dialog.alert('Найдены дубликаты в списке медиафайлов, избавьтесь от них');

        $f7.dialog.alert('Начало загрузки');
      });

      $('#options-redemption').on('change', function() {
        if($(this).is(":checked")){
          $('#bidding-redemption').closest('.list').show();
        }
        else {
          $('#bidding-redemption').closest('.list').hide();
        }
      });

      $('#options-commission').on('change', function() {
        if($(this).is(":checked")){
          $('#bidding-commission').closest('.list').show();
        }
        else {
          $('#bidding-commission').closest('.list').hide();
        }
      });

      $('#options-mystery').on('change', function() {
        if($(this).is(":checked")){
          $('#info-market').closest('.item-content').hide();
        }
        else {
          $('#info-market').closest('.item-content').show();
        }
      });

      app.request({
        url: '/server/proc/get_items_categories.php', 
        method: 'GET',
        dataType: 'json',
      })
      .then(function(res) {
        categories = res.data;
        console.log("categories", categories);
        autocompleteCategories = $f7.autocomplete.create({
          openIn: 'page', //open in page
          openerEl: '#info-category', //link that opens autocomplete
          closeOnSelect: true, //go back after we select something
          requestSourceOnOpen: true,
          pageBackLinkText: 'Назад',
          searchbarDisableText: 'Отменить',
          searchbarPlaceholder: 'Поиск...',
          notFoundText: 'Ничего не нашлось',
          source: function (query, render) {
            var results = [];
            if (query.length === 0) {
              render(categories);
              return;
            }
            // Find matched items
            for (var i = 0; i < categories.length; i++) {
              if (categories[i].toLowerCase().indexOf(query.toLowerCase()) >= 0) results.push(categories[i]);
            }
            // Render items by passing array with result items
            render(results);
          },
          on: {
            change: function (value) {
              console.log(value);
              // Add item text value to item-after
              $('#info-category').find('.item-after').text(value[0]);
              // Add item value to input value
              $('#info-category').find('input').val(value[0]);
            },
          },
        });
      });

      function createNewMediaObject(){
        let mediaCount = $('#media-objects-box').find('li').length;
        if(mediaCount >= 5) return true;
        media.push({
          file: null,
        });
        $('#media-objects-box').append(`\
          <li data-id="` + mediaCount + `">\
            <a href="#" class="item-link item-content media-upload-btn">
              <div class="item-media"><img src="/assets/img/aperture.png"
                  width="50" /></div>
              <div class="item-inner">
                <div class="item-title-row">
                  <div class="item-title">Добавить фотографию</div>
                </div>
                <div class="item-text">Нажмите чтобы выбрать файл</div>
              </div>
            </a>
            <div class="sortable-handler" style="display: none;"></div>
            <input type="file" hidden class="media-upload-input"/>
          </li>
        `);
      }
      createNewMediaObject();

      $('#media-objects-box').on('click', 'a', function(e) {
        e.preventDefault();
        let li = $(this).parent();
        let input = $(this).siblings('input');
        let file = $(input).prop('files');

        if(!file.length) $(input).click(); 
        else $f7.dialog.create({
          title: 'Что сделать с файлом?',
          text: 'Выберите действие',
          buttons: [
            {
              text: 'Изменить',
              onClick: function(dialog, e) {
                $(input).click(); 
              }
            },
            {
              text: 'Удалить',
              color: 'red',
              onClick: function(dialog, e) {
                delete media[$(li).attr('data-id')];
                $(li).remove();
              }
            },
          ],
          verticalButtons: true,
        }).open();
      });

      $('#media-objects-box').on('change', 'input', function(){
        let li = $(this).parent();
        let btn = $(this).siblings('a');
        let file = $(this).prop('files')[0];

        var reader = new FileReader();
        reader.onload = function(e) {
          $(btn).find('img').attr('src', e.target.result);
        }
        reader.readAsDataURL(file);

        if(!$(li).attr('selected')) createNewMediaObject();


console.log("file", file);
        $(li).attr('selected', true);
        $(li).find('.sortable-handler').css('display', null);
        $(li).find('.item-after').html('Изменить');
        $(li).find('.item-title').html(file.name);
        $(li).find('.item-text').html((file.size / (1024*1024)).toFixed(2) + 'MB, ' + file.type);

        media[$(li).attr('data-id')] = file;
      });

      // Date + Time
      calendarDate = $f7.calendar.create({
        inputEl: '#bidding-date',
        timePicker: true,
        minDate: date,
        timePickerPlaceholder: 'Укажите время',
        toolbarCloseText: 'Готово',
        dateFormat: { month: 'numeric', day: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric' },
      });

      var abortController = app.request.abortController();

      autocompleteCity = $f7.autocomplete.create({
        inputEl: '#info-city',
        openIn: 'dropdown',
        preloader: true,
        limit: 20,
        dropdownPlaceholderText: 'Попробуйте, "Москва"',
        source: function (query, render) {
          var autocomplete = this;
          var results = [];
          if (query.length === 0) {
            render(results);
            return;
          }
          autocomplete.preloaderShow();

          setTimeout(function() {
            if($('#info-city').val() == query){
              $f7.request({
                url: '/server/proc/address.php',
                method: 'POST',
                dataType: 'json',
                data: {
                  query: query,
                  type: 'city',
                },
                success: function (data) {
                  autocomplete.preloaderHide();
                  render(data);
                }
              });
            }
          }, 500);

        }
      });
      autocompleteAddress = $f7.autocomplete.create({
        inputEl: '#info-address',
        openIn: 'dropdown',
        preloader: true,
        limit: 20,
        dropdownPlaceholderText: 'Попробуйте, "Москва, ленинградский проспект, дом 1"',
        source: function (query, render) {
          var autocomplete = this;
          var results = [];
          if (query.length === 0) {
            render(results);
            return;
          }
          autocomplete.preloaderShow();

          setTimeout(function() {
            if($('#info-address').val() == query){
              $f7.request({
                url: '/server/proc/address.php',
                method: 'POST',
                dataType: 'json',
                data: {
                  query: query,
                  type: 'full',
                },
                success: function (data) {
                  autocomplete.preloaderHide();
                  render(data);
                }
              });
            }
          }, 500);
        }
      });
    });

    return $render;
  };


</script>