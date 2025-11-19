<?php
    require_once './libs/router/router.php';
    require_once './libs/jwt/jwt.middleware.php';
    require_once './controllers/pelicula.controller.php';
    
    $router = new Router();

    //$router->addMiddleware(new JWTMiddleware());

    //$router->addRoute('auth/login', 'GET',  'AuthApiController',    'login');
    
    $router->addRoute('peliculas', 'GET', 'PeliculaController', 'getMovies');
    $router->addRoute('peliculas/:id', 'GET', 'PeliculaController', 'getMovie');
    
    //$router->addMiddleware(new GuardMiddleware());
    //Rutas protegidas que requieren autenticación
    $router->addRoute('peliculas', 'POST', 'PeliculaController', 'addMovie');
    $router->addRoute('peliculas/:id', 'PUT', 'PeliculaController', 'editMovie');
    $router->addRoute('peliculas/:id', 'DELETE', 'PeliculaController', 'deleteMovie');
    


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);


/*
    ORDER BY =:ORDER

    IF ORDERBY
    QUERY->BIND PARAM(:ORDER,VALOR)

    order by =? */
    
