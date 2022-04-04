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
    if(data.cmd = 'change stock count'){
      $(document).find('#stocks-item-' + data.item_id).find('#stock-' + data.stock_id).find('.stock-count').val(data.count);
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