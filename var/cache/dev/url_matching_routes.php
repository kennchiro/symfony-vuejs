<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/api/article/all' => [[['_route' => 'all_article', '_controller' => 'App\\Controller\\ArticleController::allArticle'], null, ['POST' => 0], null, false, false, null]],
        '/api/article/update' => [[['_route' => 'update_article', '_controller' => 'App\\Controller\\ArticleController::updateArticle'], null, ['POST' => 0], null, false, false, null]],
        '/api/article/remove' => [[['_route' => 'remove_article', '_controller' => 'App\\Controller\\ArticleController::removeArticle'], null, ['POST' => 0], null, false, false, null]],
        '/api/author/all' => [[['_route' => 'all_author', '_controller' => 'App\\Controller\\AuthorController::allAuthor'], null, ['POST' => 0], null, false, false, null]],
        '/api/author/update' => [[['_route' => 'update_author', '_controller' => 'App\\Controller\\AuthorController::updateAuthor'], null, ['POST' => 0], null, false, false, null]],
        '/api/author/remove' => [[['_route' => 'remove_author', '_controller' => 'App\\Controller\\AuthorController::removeAuthor'], null, ['POST' => 0], null, false, false, null]],
        '/api/car/all' => [[['_route' => 'all_car', '_controller' => 'App\\Controller\\CarController::allCar'], null, ['POST' => 0], null, false, false, null]],
        '/api/car/update' => [[['_route' => 'update_car', '_controller' => 'App\\Controller\\CarController::updateCar'], null, ['POST' => 0], null, false, false, null]],
        '/api/car/remove' => [[['_route' => 'remove_car', '_controller' => 'App\\Controller\\CarController::removeCar'], null, ['POST' => 0], null, false, false, null]],
        '/api/category/all' => [[['_route' => 'all_category', '_controller' => 'App\\Controller\\CategoryController::allCategory'], null, ['POST' => 0], null, false, false, null]],
        '/api/category/update' => [[['_route' => 'update_category', '_controller' => 'App\\Controller\\CategoryController::updateCategory'], null, ['POST' => 0], null, false, false, null]],
        '/api/category/remove' => [[['_route' => 'remove_category', '_controller' => 'App\\Controller\\CategoryController::removeCategory'], null, ['POST' => 0], null, false, false, null]],
        '/api/comment/all' => [[['_route' => 'all_comment', '_controller' => 'App\\Controller\\CommentController::allComment'], null, ['POST' => 0], null, false, false, null]],
        '/api/comment/update' => [[['_route' => 'update_comment', '_controller' => 'App\\Controller\\CommentController::updateComment'], null, ['POST' => 0], null, false, false, null]],
        '/api/comment/remove' => [[['_route' => 'remove_comment', '_controller' => 'App\\Controller\\CommentController::removeComment'], null, ['POST' => 0], null, false, false, null]],
        '/api/livre/all' => [[['_route' => 'all_livre', '_controller' => 'App\\Controller\\LivreController::allLivre'], null, ['POST' => 0], null, false, false, null]],
        '/api/livre/update' => [[['_route' => 'update_livre', '_controller' => 'App\\Controller\\LivreController::updateLivre'], null, ['POST' => 0], null, false, false, null]],
        '/api/livre/remove' => [[['_route' => 'remove_livre', '_controller' => 'App\\Controller\\LivreController::removeLivre'], null, ['POST' => 0], null, false, false, null]],
        '/api/user/login' => [[['_route' => 'api_user_login', '_controller' => 'App\\Controller\\UserController::login'], null, ['POST' => 0], null, false, false, null]],
        '/api/user/logout' => [[['_route' => 'api_user_logout', '_controller' => 'App\\Controller\\UserController::logout'], null, ['POST' => 0], null, false, false, null]],
        '/api/back/user/info' => [[['_route' => 'user_info', '_controller' => 'App\\Controller\\UserController::userInfo'], null, ['GET' => 0], null, false, false, null]],
        '/api/back/user/update' => [[['_route' => 'user_update', '_controller' => 'App\\Controller\\UserController::userUpdate'], null, ['POST' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/((?!api|_(?:profiler|wdt)).*)(*:199)'
                .'|/api(?'
                    .'|(?:/(index)(?:\\.([^/]++))?)?(*:242)'
                    .'|/(?'
                        .'|docs(?:\\.([^/]++))?(*:273)'
                        .'|contexts/(.+)(?:\\.([^/]++))?(*:309)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        199 => [[['_route' => 'vue_routing', '_controller' => 'App\\Controller\\RootController::index'], ['vueRouting'], null, null, false, true, null]],
        242 => [[['_route' => 'api_entrypoint', '_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => 'true', 'index' => 'index'], ['index', '_format'], null, null, false, true, null]],
        273 => [[['_route' => 'api_doc', '_controller' => 'api_platform.action.documentation', '_format' => '', '_api_respond' => 'true'], ['_format'], null, null, false, true, null]],
        309 => [
            [['_route' => 'api_jsonld_context', '_controller' => 'api_platform.jsonld.action.context', '_format' => 'jsonld', '_api_respond' => 'true'], ['shortName', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
