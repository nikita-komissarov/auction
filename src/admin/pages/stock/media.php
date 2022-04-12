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
        <div class="title">Редактирование медиа #${props.id}</div>
      </div>
    </div>
    <div class="searchbar-backdrop"></div>
    <div class="page-content">
      <div id="media-input"></div>
        <div class="list inset">
          <ul>
            <li><a class="list-button" id="media-save">Сохранить медифайлы</a></li>
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
    var items = $store.getters.items;
    console.log("items", items);
    var item_id = items.value.findIndex(el => el.id == props.id);

    $on('pageInit', (e, page) => { 
      let mediaId = createMediaInit($el.value.find('#media-input'));


      sortObjectByValue = (object, element) => {
        let keys = Object.keys(object);
        return keys.sort((key_a, key_b) => {
          return object[key_b][element] + object[key_a][element];
        });
      };

      if(items.value[item_id].info.media.length){
        let length = items.value[item_id].info.media.length;
        let dialog = $f7.dialog.progress('Буферизация медиафайлов', 0);
        dialog.setText('Файл 1 из ' + length);
        items.value[item_id].info.media.forEach((url, index) => {
          $f7.request({
            url: '/server/proc/stock/media/get.php',
            method: 'POST',
            dataType: 'text',
            data: {
              url: url,
            },
            success: function (data) {
              createMediaInsertItem(mediaId, data, 'Изображение #' + (index + 1));

              let progress = ((index + 1) * 100 / length);
              dialog.setProgress(progress);
              dialog.setText('Файл ' + (index + 1) + ' из ' + length);
              if(progress === 100) dialog.close();
            },
            error: function (data) {
              $f7.dialog.close();
            }
          });
          //createMediaAddItem(mediaId, item);
        });
      }

      $el.value.find('#media-save').on('click', function(){
        let list = mediaInput[mediaId];
        let length = list.length - 1;
        if(!list.length){
          return true;
        }

        function uploadFiles(list, id = 0, dialog = null){
          if((list.length - 1) < id) {
            $f7.dialog.close();
            $f7.dialog.progress('Обработка триггеров...');
            setTimeout(function() {
              $f7.dialog.close();
            }, 1500);
          }
          else {
            if(!dialog) dialog = $f7.dialog.progress('Загрузка медиафайлов', 0);
            let progress = ((id + 1) * 100 / list.length);
            dialog.setProgress(progress);
            dialog.setText('Файл ' + (id + 1) + ' из ' + list.length);

            $f7.request({
              url: '/server/proc/stock/media.php',
              method: 'POST',
              dataType: 'json',
              data: list[id],
              success: function (data) {
                uploadFiles(list, (id + 1), dialog);
              },
              error: function (data) {
                $f7.dialog.close();
                $f7.dialog.alert('Ошибка при загрузке медиафайла.');
              }
            });
          }
        }

        $f7.dialog.close();
        $f7.dialog.progress('Очистка каталога...');
        $f7.request({
          url: '/server/proc/stock/media/clear.php',
          method: 'POST',
          dataType: 'json',
          data: {
            item: 2,
          },
          success: function (data) {
            $f7.dialog.close();
            $f7.dialog.progress('Буферизация...');
            let data_list = new Array();
            list.forEach((item, index) => {
              if(item == null) return;
              var data = new FormData();

              data.append('item', 2);
              data.append('id', index);
              data.append('file', item);

              data_list.push(data);
            });
            setTimeout(function() {
              $f7.dialog.close();
              uploadFiles(data_list);
            }, 750);
          },
          error: function (data) {
            $f7.dialog.close();
            $f7.dialog.alert('Ошибка при попытке очистить каталог медиафайлов');
          }
        });
      });
    });

    return $render;
  }
</script>