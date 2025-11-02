<?php
    require_once './libs/router/router.php';
    require_once './libs/jwt/jwt.middleware.php';

    $router = new Router();

    $router->addMiddleware(new JWTMiddleware());

    $router->addRoute('auth/login', 'GET',  'AuthApiController',    'login');


    $router->addRoute('peliculas/:id', 'GET', 'AdminApiController', 'getMovie');
    
    $router->addMiddleware(new GuardMiddleware());
    $router->addRoute('peliculas', 'POST', 'AdminApiController', 'insertMovie');
    




    ORDER BY =:ORDER

    IF ORDERBY
    QUERY->BIND PARAM(:ORDER,VALOR)

    order by =? 
    
?>