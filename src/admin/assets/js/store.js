function setMenuCount(el, color, value, showNull = false){
  console.log("el", el);
  console.log("value", value);
  if(!value && !showNull) el.innerHTML = '';
  else el.innerHTML = '<span class="badge color-' + color + '">' + value + '</span>';
  return true;
  //
}

function storeMenuCountPhotoDesc(items){
  console.log("items", items);

  let countPhoto = 0;
  let countDescription = 0;

  items.forEach(function(item){
    if(!item.info.media.length) countPhoto++;
    if(!item.info.description) countDescription++;
  });
  return {
    photo: countPhoto,
    description: countDescription,
  };
}

var store = Framework7.createStore({
  state: {
    items: [],
    stocks: [],
    categories: [],
    loaded: false,
  },
  actions: {
    loadStocks({ state }) {
      fetch('/server/proc/stock/list.php')
      .then((res) => res.json())
      .then((stocks) => {
        state.stocks = stocks;
      });
    },
    loadCategories({ state }) {
      fetch('/server/proc/stock/categories.php')
      .then((res) => res.json())
      .then((categories) => {
        state.categories = categories;
      });
    },
    loadItems({ state }) {
      fetch('/server/proc/stock/items.php')
      .then((res) => res.json())
      .then((items) => {
        state.items = items;
        state.loaded = true;

        let count = storeMenuCountPhotoDesc(items);
        setMenuCount(document.getElementById('menu-count-photo'), 'red', count.photo);
        setMenuCount(document.getElementById('menu-count-description'), 'red', count.description);
      });

    },
    reloadItem({ state }, { item_id }) {
      fetch('/server/proc/stock/items.php?id=' + item_id)
      .then((res) => res.json())
      .then((item) => {
        //Записываем текущий массив временно
        let tmpItems = state.items;
        //Получаем индекс этого товара в массиве по параметру ID
        let index = tmpItems.findIndex(el => el.id == item_id);
        //Создаём новый элемент если позиция новая
        if(index == -1) tmpItems.push(item[0]);
        //Заменяем найдя нужный индекс на данные пришедшие от сервера
        else tmpItems[index] = item[0];
        //Вписываем отредактированный массив назад для поддержки реактивности
        state.items = tmpItems;

        let count = storeMenuCountPhotoDesc(state.items);
        setMenuCount(document.getElementById('menu-count-photo'), 'red', count.photo);
        setMenuCount(document.getElementById('menu-count-description'), 'red', count.description);
      });
    },
  },
  getters: {
    stocks({ state }) {
      return state.stocks;
    },
    categories({ state }) {
      return state.categories;
    },
    items({ state }) {
      return state.items;
    },
    loaded({ state }) {
      return state.loaded;
    },
  },
});

store.dispatch('loadStocks');
store.dispatch('loadCategories');
store.dispatch('loadItems');

var appScript = document.createElement('script');
appScript.setAttribute('src','/assets/js/app.js');
document.body.appendChild(appScript);