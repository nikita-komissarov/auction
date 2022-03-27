var routes = [
  // Index page
  {
    path: '/',
    componentUrl: './pages/home.php',
    name: 'home',
  },
  {
    path: '/lot/create/',
    componentUrl: './pages/lot/create.php',
    name: 'lot-create',
  },
  // Default route (404 page). MUST BE THE LAST
  {
    path: '(.*)',
    url: './pages/404.php',
  },
];
