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