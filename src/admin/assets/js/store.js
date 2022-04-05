var store = Framework7.createStore({
  state: {
    items: [],
    stocks: [],
  },
  actions: {
    loadStocks({ state }) {
      fetch('/server/proc/stock/list.php')
      .then((res) => res.json())
      .then((stocks) => {
        state.stocks = stocks;
      });
    },
    loadItems({ state }) {
      fetch('/server/proc/stock/items.php')
      .then((res) => res.json())
      .then((items) => {
        state.items = items;
      });
    },
    reloadItem({ state }, { item_id }) {
      fetch('/server/proc/stock/items.php?id=' + item_id)
      .then((res) => res.json())
      .then((item) => {
        //Записываем текущий массив временно
        let tmpItems = state.items;
        //Заменяем найдя нужный индекс на данные пришедшие от сервера
        tmpItems[tmpItems.findIndex(el => el.id == item_id)] = item[0];
        //Вписываем отредактированный массив назад для поддержки реактивности
        state.items = tmpItems;
      });
    },
  },
  getters: {
    stocks({ state }) {
      return state.stocks;
    },
    items({ state }) {
      return state.items;
    },
  },
});

store.dispatch('loadStocks');
store.dispatch('loadItems');
