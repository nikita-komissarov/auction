// Dom7
var $ = Dom7;

// Init App
var app = new Framework7({
  id: 'io.framework7.testapp',
  el: '#app',
  theme: 'ios',
  // store.js,
  store: store,
  // routes.js,
  routes: routes,
  dialog: {
    title: 'Панель управления',
  },
  popup: {
    closeOnEscape: true,
  },
  sheet: {
    closeOnEscape: true,
  },
  popover: {
    closeOnEscape: true,
  },
  actions: {
    closeOnEscape: true,
  },
});

var ws;

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if(parts.length === 2) return parts.pop().split(';').shift();
}

window.onload = function () {
  ws = new WebSocket('ws://localhost:7777?key=' + getCookie('AUCTION-ADMIN-ID'));
  ws.onmessage = function(message) {
    let data = JSON.parse(JSON.parse(message.data.trim()));
    console.log("data", data);
    if(data.cmd = 'change item') {
      return store.dispatch('reloadItem', {
        item_id: data.item_id,
      });
    }
  };
};

var scannerFocusEl = null;
$(document).keydown(function(event) {
  if(event.which == 113) {
    $(scannerFocusEl[scannerFocusEl.length - 1]).val('').focus();
  }
});

function getVal(input){
  if(!$(input).val()) return null;
  return $(input).val().trim();
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

let mediaInput = new Array();

function createMediaInit(el){
  let id = app.utils.id();

  mediaInput[id] = new Array();
  let block = $(`<div class="list media-list inset sortable sort-media" id="media-input-div-${id}"><ul></ul></div>`);
  $(el).append(block);
  app.sortable.enable(`#media-input-div-${id}`);
  createMediaInput(block, id);

  return id;
}

function createMediaGetList(id){
  console.log("id", id);
  let el = $(document).find(`#media-input-div-${id}`);
  let list_li = $(el).find('li');
  let list_files = new Array();
  list_li.forEach((li, index) => {
    if(mediaInput[id][$(li).attr('data-id')] != null){
      list_files.push({
        id: $(li).attr('data-id'),
        file: mediaInput[id][$(li).attr('data-id')]
      });
    }
  });

  return list_files;
}

function createMediaInput(el, block_id){
  if(Object.keys(mediaInput[block_id]).length >= 5) return true;
  let id = app.utils.id();
  mediaInput[block_id][id] = null;
  let li = $(`
    <li id="media-input-${id}" data-id="${id}">
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
  $(el).find('ul').append(li);

  $(li).find('a').off('click');
  $(li).find('a').on('click', function(e) {
    e.preventDefault();
    if(mediaInput[block_id][id] == null) {
      return $(li).find('input').click();
    }
    else app.dialog.create({
      title: 'Что сделать с файлом?',
      text: 'Выберите действие',
      buttons: [
        {
          text: 'Изменить',
          onClick: function(dialog, e) {
            $(li).find('input').click(); 
          }
        },
        {
          text: 'Удалить',
          color: 'red',
          onClick: function(dialog, e) {
            delete mediaInput[block_id][id];
            $(li).remove();
            if($(el).find('li').length == $(el).find('.selected').length) {
              createMediaInput(el, block_id);
            }
          }
        },
      ],
      verticalButtons: true,
    }).open();
  });

  $(li).find('input').off('change');
  $(li).find('input').on('change', function(){
    let file = $(this).prop('files')[0];

    var reader = new FileReader();
    reader.onload = function(e) {
      $(li).find('img').attr('src', e.target.result);
    }
    reader.readAsDataURL(file);

    if(!$(li).hasClass('selected')) createMediaInput(el, block_id);
    $(li).addClass('selected');
    $(li).find('.sortable-handler').css('display', null);
    $(li).find('.item-title').html(file.name);
    $(li).find('.item-text').html((file.size / (1024*1024)).toFixed(2) + 'MB, ' + file.type);

    mediaInput[block_id][id] = file;
  });
}