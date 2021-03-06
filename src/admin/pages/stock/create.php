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
        <div class="title">Добавление нового товара</div>
        <div class="right">
          <a href="#" class="item-autocomplete-btn">
            <i class="f7-icons">doc_text_viewfinder</i>
          </a>
        </div>
      </div>
    </div>
    <div class="page-content">
      <form id="form-lot-create">
        <div class="block-title">Основная информация</div>
        <div class="list inset">
          <ul>
            <li>
              <a class="item-link item-content" href="#" id="category">
                <input type="hidden" />
                <div class="item-inner">
                  <div class="item-title">Категория</div>
                  <div class="item-after"></div>
                </div>
              </a>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Артикул</div>
                <div class="item-input-wrap">
                  <input id="article" class="scanner-input" type="number" placeholder="Артикул на упаковке"/>
                  <span class="input-clear-button"></span>
                  <div class="item-input-info">Используйте сканер штрих-кода</div>
                </div>
              </div>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Название товара</div>
                <div class="item-input-wrap">
                  <input id="name" type="text" placeholder="Название товара" />
                  <span class="input-clear-button"></span>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="block-title">Дополнительная информация</div>
        <div class="list inset">
          <ul>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">ID в Яндекс.Маркет</div>
                <div class="item-input-wrap">
                  <input id="market-id" type="number" placeholder="558171067"/>
                  <span class="input-clear-button"></span>
                </div>
              </div>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Ссылка на страницу Яндекс.Маркет</div>
                <div class="item-input-wrap">
                  <input id="market-url" type="text" placeholder="https://market.yandex.ru/"/>
                  <span class="input-clear-button"></span>
                </div>
              </div>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Стоимость продажи в розницу</div>
                <div class="item-input-wrap">
                  <input id="price" type="number" placeholder="Стоимость продажи в розницу" />
                  <span class="input-clear-button"></span>
                </div>
              </div>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Описание товара</div>
                <div class="item-input-wrap">
              <div 
                class="text-editor text-editor-resizable"
                data-placeholder="Введите описание товара">
                <div id="description" class="text-editor-content" contenteditable></div>
              </div>
            </div>
          </div>
            </li>
          </ul>
        </div>
        <div class="list inset">
          <ul>
            <li><a class="list-button" id="button-item-create">Добавить товар</a></li>
          </ul>
        </div>
      </form>
    </div>
  </div>
</template>
<style>
  .text-editor table {
    width: 100%;
  }
  .text-editor table td {
    width: 50%;
  }
</style>
<script>
  export default (props, { $, $f7, $el, $on }) => {

    let textEditor;

    $on('pageInit', (e, page) => {
      scannerFocusEl = $(page.el).find('.scanner-input');

      $('.item-autocomplete-btn').on('click', function(e){
        e.preventDefault();
        $f7.dialog.prompt(
          'Введите ID товара для автозаполнения формы',
          'Яндекс.Маркет',
          function (ym_id) {
            let test = /^[0-9]+$/.test(ym_id);
            if(!test) {
              return $f7.dialog.alert('Используйте только цифры<br><br><b>Изменения не применены</b>');
            }
            $f7.dialog.progress('Загрузка данных с Яндекс.Маркет');
            $f7.request({
              url: '/server/proc/stock/ym-autocomplete.php',
              method: 'POST',
              dataType: 'json',
              data: {
                id: ym_id,
              },
              success: function (data) {
                $f7.dialog.close();

                console.log("data", data);
                if(data.info.error == undefined){
                  $el.value.find('#name').val(data.info.name);
                  $el.value.find('#price').val(data.info.price);
                  $el.value.find('#market-id').val(data.info.id);
                  $el.value.find('#market-url').val(data.info.url);
                }
                
                if(data.specs.error == undefined){
                  let specText = '';
                  data.specs.specifications.forEach((spec, index) => {
                    specText += `<h4>${spec.name}</h4><table>`;
                    spec.subspecs.forEach((subspec, index) => {
                      specText += `<tr><td>${subspec.name}</td><td>${subspec.value}</td></tr>`;
                    });
                    specText += `</table>`;
                  });

                  textEditor.setValue(specText);
                }
              },
              error: function (data) {
                $f7.dialog.close();
                $f7.dialog.alert('Ошибка получения данных');
              }
            });
          },
          function () {},
        ).once('opened', function(event){
          let el = event.el;
          $(el).find('input')
            .attr('type', 'number')
            .attr('min', '1')
            .attr('placeholder', 'ID на Яндекс.Маркет');
          console.log("el", el);
        });
      });

      textEditor = $f7.textEditor.create({
        el: $el.value.find('.text-editor'),
        placeholder: 'Введите описание товара',
        mode: 'popover',
        linkUrlText: 'Вставьте ссылку',
        buttons: [
          ['bold', 'italic', 'underline', 'strikeThrough'],
          ['orderedList', 'unorderedList'],
          ['h2', 'h3'],
          ['link'],
        ],
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
          openerEl: $el.value.find('#category'), //link that opens autocomplete
          closeOnSelect: true, //go back after we select something
          requestSourceOnOpen: true,
          pageBackLinkText: 'Назад',
          searchbarDisableText: 'Отменить',
          searchbarPlaceholder: 'Поиск...',
          valueProperty: 'id',
          textProperty: 'text',
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
              $el.value.find('#category').find('.item-after').text(value[0].text);
              $el.value.find('#category').find('input').val(value[0].id);
            },
          },
        });
      });

      $('#button-item-create').on('click', function() {
        let form = new Object();

        form = {
          article: +getVal($el.value.find('#article')),
          name: getVal($el.value.find('#name')),
          category: +getVal($el.value.find('#category').find('input')),

          price: +getVal($el.value.find('#price')),
          marketId: +getVal($el.value.find('#market-id')),
          marketUrl: getVal($el.value.find('#market-url')),
          description: textEditor.getValue(),
        };

console.log("form", form);

        if(form.article == 0) return $f7.dialog.alert('Укажите артикул товара');
        if(!form.name) return $f7.dialog.alert('Укажите название товара');
        if(form.price == 0) return $f7.dialog.alert('Укажите стоимость товара');
        if(form.category == 0) return $f7.dialog.alert('Укажите категорию товара');

        $f7.dialog.preloader('Создание товара...');
        $f7.request({
          url: '/server/proc/shop/create.php',
          method: 'POST',
          dataType: 'json',
          data: {
            article: form.article,
            name: form.name,
            category: form.category,

            marketId: form.marketId,
            marketUrl: form.marketUrl,
            price: form.price,
            description: form.description,
          },
          success: function (data) {
            console.log("data", data);
            if(data == 'article is exist') {
              $f7.dialog.close();
              return $f7.dialog.create({
                title: form.article,
                text: 'Этот артикул уже существует',
                buttons: [
                  {
                    text: 'Ок',
                  },
                ],
                verticalButtons: true,
              }).open();
            }

            $f7.dialog.close();
            $f7.dialog.alert('Товар успешно добавлен');

            $el.value.find('#article').val(null);
            $el.value.find('#name').val(null);
            
            $el.value.find('#category').find('.item-after').text('');
            $el.value.find('#category').find('input').val(0);

            $el.value.find('#price').val(null);
            $el.value.find('#market').val(null);

            textEditor.clearValue();
          },
          error: function (data) {
            $f7.dialog.close();
            $f7.dialog.alert('Ошибка создания товара');
          }
        });
        // $f7.dialog.create({
        //   title: 'Подтвердите сохранение',
        //   buttons: [
        //     {
        //       text: 'Подтвердить',
        //       onClick: function(dialog, e) {
        //       }
        //     },
        //     {
        //       text: 'Редактировать',
        //       color: 'red',
        //     },
        //   ],
        //   verticalButtons: true,
        // }).open();
      });
    });
    $on('pageBeforeRemove', () => {
      textEditor.destroy()
    });

    return $render;
  };


</script>