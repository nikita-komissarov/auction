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
  // Default route (404 page). MUST BE THE LAST
  {
    path: '(.*)',
    url: './pages/404.php',
  },
];
