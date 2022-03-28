<template>
  <div class="page no-navbar no-toolbar no-swipeback">
    <div class="page-content login-screen-content" style="display: flex;">
      <div style="margin: auto;">
        <div class="login-screen-title">Авторизация</div>
        <form>
          <div class="list">
            <ul>
              <li class="item-content item-input">
                <div class="item-inner">
                  <div class="item-title item-label">Имя пользователя</div>
                  <div class="item-input-wrap">
                    <input id="signin-username" type="text" name="username" placeholder="Имя пользователя" />
                  </div>
                </div>
              </li>
              <li class="item-content item-input">
                <div class="item-inner">
                  <div class="item-title item-label">Пароль</div>
                  <div class="item-input-wrap">
                    <input id="signin-password" type="password" name="password" placeholder="Пароль" />
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="list">
            <ul>
              <li><a href="#" class="list-button" id="signin-btn">Войти в аккаунт</a></li>
            </ul>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default (props, { $, $f7, $on }) => {

    $on('pageInit', () => {
      $('#signin-btn').on('click', function(){
        let username = $('#signin-username').val().trim();
        let password = $('#signin-password').val().trim();

        if(username.length && password.length){
          app.request({
            url: '/server/proc/auth.php', 
            method: 'POST',
            dataType: 'json',
            data: {
              username: username,
              password: password
            },
          })
          .then(function(res) {
            if(res.data == 'ok') window.location.reload();
            else $f7.dialog.create({
              title: 'Ошибка авторизации',
              text: 'Проверьте указанные данные',
              buttons: [
                {
                  text: 'Ок',
                },
              ],
            }).open();
          });
          
        }
      });
    });

    return $render;
  };


</script>