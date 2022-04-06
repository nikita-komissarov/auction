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
    var item_id = items.value.findIndex(el => el.id == props.id);

    $on('pageInit', (e, page) => { 
      let mediaId = createMediaInit($el.value.find('#media-input'));
      console.log("mediaId", mediaId);

      $el.value.find('#media-save').on('click', function(){
        let list = createMediaGetList(mediaId);
        console.log("list", list);

        var progress = 0;
        var dialog = $f7.dialog.progress('Зарузка медиафайлов', progress);
        dialog.setText('Файл 1 из ' + list.length);

        list.forEach((item, index) => {
          console.log("index", index);
          var data = new FormData();

          data.append('item', 2);
          data.append('id', item.id);
          data.append('file', item.file);
          console.log("data", data);

          $f7.request({
            url: '/server/proc/stock/media.php',
            method: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
              progress = ((index + 1) * 100 / list.length);
              console.log("progress", progress);

              dialog.setProgress(progress);
              dialog.setText('Файл ' + (index + 1) + ' из ' + list.length);
              if(progress === 100) {
                dialog.close();
                $f7.dialog.alert('Медиафайлы успешно загружены');
              }
            },
            error: function (data) {
              $f7.dialog.close();
            }
          });
        });

      });
    });

    return $render;
  }
</script>