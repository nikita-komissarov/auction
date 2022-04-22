var routes = [
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
    path: '/stock/create/',
    componentUrl: './pages/stock/create.php',
    name: 'stock-create',
    options: {
      reloadCurrent: true,
    },
  },
  {
    path: '/stock/search/',
    componentUrl: './pages/stock/search.php',
    name: 'stock-search',
    options: {
      reloadCurrent: true,
    },
  },
  {
    path: '/stock/item/:id/',
    componentUrl: './pages/stock/item.php',
  },
  {
    path: '/stock/item/media/:id/',
    componentUrl: './pages/stock/media.php',
  },
  // Default route (404 page). MUST BE THE LAST
  {
    path: '(.*)',
    url: './pages/404.php',
  },
];
