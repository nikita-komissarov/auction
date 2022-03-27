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
        <div class="block-title block-title-medium">Фото и видео</div>
        <div class="list inset">
          <ul id="media-objects-box"></ul>
        </div>
        <div class="list inset">
          <ul>
            <li><a class="list-button" id="button-lot-create">Создать лот</a></li>
          </ul>
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
                <div class="item-title item-label">Страница из магазина</div>
                <div class="item-input-wrap">
                  <input id="info-market" type="text" placeholder="https://market.yandex.ru/" value="https://market.yandex.ru/product--smartfon-apple-iphone-11/558171067" />
                  <span class="input-clear-button"></span>
                </div>
              </div>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Дополнительное описание</div>
                <div class="item-input-wrap">
                  <textarea id="info-desc" placeholder="Опишите важные">
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  </textarea>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="block-title block-title-medium">Опции торгов</div>
        <div class="list inset simple-list">
          <ul>
            <li>
              <span>Возможность выкупа</span>
              <label class="toggle toggle-init">
                <input type="checkbox" checked />
                <span class="toggle-icon"></span>
              </label>
            </li>
            <li>
              <span>Комиссия посредника</span>
              <label class="toggle toggle-init">
                <input type="checkbox" checked />
                <span class="toggle-icon"></span>
              </label>
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
                    <input type="text" placeholder="Выберите дату и время начала торгов" readonly="readonly"
                      id="calendar-date-time-start" value="01.03.2022, 22:00" />
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="item-content item-input">
                <div class="item-inner">
                  <div class="item-title item-label">Дата и время окончания</div>
                  <div class="item-input-wrap">
                    <input type="text" placeholder="Выберите дату и время окончания торгов" readonly="readonly"
                      id="calendar-date-time-end" value="27.03.2022, 23:00" />
                  </div>
                </div>
              </div>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Стартовая цена</div>
                <div class="item-input-wrap">
                  <input type="number" placeholder="1000" value="1000" />
                  <span class="input-clear-button"></span>
                </div>
              </div>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Цена выкупа</div>
                <div class="item-input-wrap">
                  <input type="number" placeholder="5000" value="5000" />
                  <span class="input-clear-button"></span>
                </div>
              </div>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Комиссия посредника в процентах</div>
                <div class="item-input-wrap">
                  <input type="number" placeholder="10" value="10" />
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
    let calendarDateTimeStart;
    let calendarDateTimeEnd;

    let autocompleteCity;
    let autocompleteAddress;

    let media = [];

    $on('pageInit', () => {

      function createNewMediaObject(){
        let mediaCount = $('#media-objects-box').find('li').length;
        media.push({
          file: null,
        });
        $('#media-objects-box').append('\
          <li data-id="' + mediaCount + '">\
            <a href="#" class="item-link item-content media-upload-btn">\
              <div class="item-media"><img src="https://cdn.framework7.io/placeholder/fashion-88x88-4.jpg"\
                  width="50" /></div>\
              <div class="item-inner">\
                <div class="item-title">Фотография</div>\
                <div class="item-after">Выбрать</div>\
              </div>\
            </a>\
            <input type="file" hidden class="media-upload-input"/>\
          </li>\
        ');
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

        $(li).attr('selected', true);
        media[$(li).attr('data-id')] = file;
      });

      function getVal(input){
        return $(input).val().trim();
      }

      $('#button-lot-create').on('click', function() {
        let data = new Object();
        data.info = {
          type: +getVal($('#info-type')),
          name: getVal($('#info-name')),
          city: getVal($('#info-city')),
          address: getVal($('#info-address')),
          average: getVal($('#info-average')),
          market: getVal($('#info-market')),
          desc: getVal($('#info-desc')),
        };
        data.options = new Object();
        data.bidding = new Object();
        data.media = new Object();


console.log("data", data);
      });

      // Date + Time
      calendarDateTimeStart = $f7.calendar.create({
        inputEl: '#calendar-date-time-start',
        timePicker: true,
        dateFormat: { month: 'numeric', day: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric' },
      });
      calendarDateTimeEnd = $f7.calendar.create({
        inputEl: '#calendar-date-time-end',
        timePicker: true,
        dateFormat: { month: 'numeric', day: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric' },
      });

      autocompleteCity = $f7.autocomplete.create({
        inputEl: '#autocomplete-city',
        openIn: 'dropdown',
        preloader: true, //enable preloader
        /* If we set valueProperty to "id" then input value on select will be set according to this property */
        valueProperty: 'name', //object's "value" property name
        textProperty: 'name', //object's "text" property name
        limit: 5, //limit to 20 results
        dropdownPlaceholderText: 'Try "JavaScript"',
        source: function (query, render) {
          var autocomplete = this;
          var results = [];
          if (query.length === 0) {
            render(results);
            return;
          }
          // Show Preloader
          autocomplete.preloaderShow();

          // Do Ajax request to Autocomplete data
          $f7.request({
            url: './autocomplete-languages.json',
            method: 'GET',
            dataType: 'json',
            //send "query" to server. Useful in case you generate response dynamically
            data: {
              query: query,
            },
            success: function (data) {
              // Find matched items
              for (var i = 0; i < data.length; i++) {
                if (data[i].name.toLowerCase().indexOf(query.toLowerCase()) >= 0) results.push(data[i]);
              }
              // Hide Preoloader
              autocomplete.preloaderHide();
              // Render items by passing array with result items
              render(results);
            }
          });
        }
      });
    });

    return $render;
  };


</script>