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
      </div>
    </div>
    <div class="page-content">
      <form id="form-lot-create">
        <div class="block-title block-title-medium">Основная информация</div>
        <div class="list inset">
          <ul>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Артикул</div>
                <div class="item-input-wrap">
                  <input id="info-name" type="number" placeholder="Артикул на упаковке" />
                  <span class="input-clear-button"></span>
                  <div class="item-input-info">Используйте сканер штрих-кода</div>
                </div>
              </div>
            </li>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Название товара</div>
                <div class="item-input-wrap">
                  <input id="info-name" type="text" placeholder="Название товара"/>
                  <span class="input-clear-button"></span>
                </div>
              </div>
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
          </ul>
        </div>
        <div class="block-title block-title-medium">Дополнительная информация</div>
        <div class="list inset">
          <ul>
            <li class="item-content item-input">
              <div class="item-inner">
                <div class="item-title item-label">Стоимость выкупа и продажи в розницу</div>
                <div class="item-input-wrap">
                  <input id="info-name" type="number" placeholder="Стоимость выкупа и продажи в розницу"/>
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
        <div class="list inset">
          <ul>
            <li><a class="list-button" id="button-lot-create">Добавить товар</a></li>
          </ul>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  export default (props, { $, $f7, $on }) => {

    $on('pageInit', () => {
    });

    return $render;
  };


</script>