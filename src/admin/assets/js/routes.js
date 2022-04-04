var routes = [
  // Index page
  {
    path: '/',
    componentUrl: './pages/home.php',
    name: 'home',
  },
  {
    path: '/auth/',
    componentUrl: './pages/auth.php',
    name: 'auth',
  },
  {
    path: '/lot/create/',
    componentUrl: './pages/lot/create.php',
    name: 'lot-create',
  },
  {
    path: '/shop/create/',
    componentUrl: './pages/shop/create.php',
    name: 'shop-create',
  },
  {
    path: '/stock/search/',
    componentUrl: './pages/stock/search.php',
    name: 'stock-search',
  },
  {
    path: '/stock/item/:id/',
    async: function ({ router, to, resolve }) {
      // App instance
      var app = router.app;
      // Show Preloader
      app.preloader.show();
      // Simulate Ajax Request
      app.request({
        url: '/server/proc/stock/item.php',
        method: 'POST',
        dataType: 'json',
        data: {
          id: to.params.id
        },
        success: function (item) {
          app.preloader.hide();
          resolve({
              componentUrl: './pages/stock/item.php',
            },
            {
              props: {
                item: item,
              }
            }
          );
        },
      });
    },
  },
  // Default route (404 page). MUST BE THE LAST
  {
    path: '(.*)',
    url: './pages/404.php',
  },
];
