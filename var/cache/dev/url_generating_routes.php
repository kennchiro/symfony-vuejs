<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], []],
    '_wdt' => [['token'], ['_controller' => 'web_profiler.controller.profiler::toolbarAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_wdt']], [], []],
    '_profiler_home' => [[], ['_controller' => 'web_profiler.controller.profiler::homeAction'], [], [['text', '/_profiler/']], [], []],
    '_profiler_search' => [[], ['_controller' => 'web_profiler.controller.profiler::searchAction'], [], [['text', '/_profiler/search']], [], []],
    '_profiler_search_bar' => [[], ['_controller' => 'web_profiler.controller.profiler::searchBarAction'], [], [['text', '/_profiler/search_bar']], [], []],
    '_profiler_phpinfo' => [[], ['_controller' => 'web_profiler.controller.profiler::phpinfoAction'], [], [['text', '/_profiler/phpinfo']], [], []],
    '_profiler_search_results' => [['token'], ['_controller' => 'web_profiler.controller.profiler::searchResultsAction'], [], [['text', '/search/results'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
    '_profiler_open_file' => [[], ['_controller' => 'web_profiler.controller.profiler::openAction'], [], [['text', '/_profiler/open']], [], []],
    '_profiler' => [['token'], ['_controller' => 'web_profiler.controller.profiler::panelAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
    '_profiler_router' => [['token'], ['_controller' => 'web_profiler.controller.router::panelAction'], [], [['text', '/router'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
    '_profiler_exception' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::body'], [], [['text', '/exception'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
    '_profiler_exception_css' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::stylesheet'], [], [['text', '/exception.css'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
    'all_article' => [[], ['_controller' => 'App\\Controller\\ArticleController::allArticle'], [], [['text', '/api/article/all']], [], []],
    'update_article' => [[], ['_controller' => 'App\\Controller\\ArticleController::updateArticle'], [], [['text', '/api/article/update']], [], []],
    'remove_article' => [[], ['_controller' => 'App\\Controller\\ArticleController::removeArticle'], [], [['text', '/api/article/remove']], [], []],
    'all_author' => [[], ['_controller' => 'App\\Controller\\AuthorController::allAuthor'], [], [['text', '/api/author/all']], [], []],
    'update_author' => [[], ['_controller' => 'App\\Controller\\AuthorController::updateAuthor'], [], [['text', '/api/author/update']], [], []],
    'remove_author' => [[], ['_controller' => 'App\\Controller\\AuthorController::removeAuthor'], [], [['text', '/api/author/remove']], [], []],
    'all_car' => [[], ['_controller' => 'App\\Controller\\CarController::allCar'], [], [['text', '/api/car/all']], [], []],
    'update_car' => [[], ['_controller' => 'App\\Controller\\CarController::updateCar'], [], [['text', '/api/car/update']], [], []],
    'remove_car' => [[], ['_controller' => 'App\\Controller\\CarController::removeCar'], [], [['text', '/api/car/remove']], [], []],
    'all_category' => [[], ['_controller' => 'App\\Controller\\CategoryController::allCategory'], [], [['text', '/api/category/all']], [], []],
    'update_category' => [[], ['_controller' => 'App\\Controller\\CategoryController::updateCategory'], [], [['text', '/api/category/update']], [], []],
    'remove_category' => [[], ['_controller' => 'App\\Controller\\CategoryController::removeCategory'], [], [['text', '/api/category/remove']], [], []],
    'all_comment' => [[], ['_controller' => 'App\\Controller\\CommentController::allComment'], [], [['text', '/api/comment/all']], [], []],
    'update_comment' => [[], ['_controller' => 'App\\Controller\\CommentController::updateComment'], [], [['text', '/api/comment/update']], [], []],
    'remove_comment' => [[], ['_controller' => 'App\\Controller\\CommentController::removeComment'], [], [['text', '/api/comment/remove']], [], []],
    'all_livre' => [[], ['_controller' => 'App\\Controller\\LivreController::allLivre'], [], [['text', '/api/livre/all']], [], []],
    'update_livre' => [[], ['_controller' => 'App\\Controller\\LivreController::updateLivre'], [], [['text', '/api/livre/update']], [], []],
    'remove_livre' => [[], ['_controller' => 'App\\Controller\\LivreController::removeLivre'], [], [['text', '/api/livre/remove']], [], []],
    'vue_routing' => [['vueRouting'], ['_controller' => 'App\\Controller\\RootController::index'], ['vueRouting' => '(?!api|_(profiler|wdt)).*'], [['variable', '/', '(?!api|_(?:profiler|wdt)).*', 'vueRouting', true]], [], []],
    'api_user_login' => [[], ['_controller' => 'App\\Controller\\UserController::login'], [], [['text', '/api/user/login']], [], []],
    'api_user_logout' => [[], ['_controller' => 'App\\Controller\\UserController::logout'], [], [['text', '/api/user/logout']], [], []],
    'user_info' => [[], ['_controller' => 'App\\Controller\\UserController::userInfo'], [], [['text', '/api/back/user/info']], [], []],
    'user_update' => [[], ['_controller' => 'App\\Controller\\UserController::userUpdate'], [], [['text', '/api/back/user/update']], [], []],
    'api_entrypoint' => [['index', '_format'], ['_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => 'true', 'index' => 'index'], ['index' => 'index'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', 'index', 'index', true], ['text', '/api']], [], []],
    'api_doc' => [['_format'], ['_controller' => 'api_platform.action.documentation', '_format' => '', '_api_respond' => 'true'], [], [['variable', '.', '[^/]++', '_format', true], ['text', '/api/docs']], [], []],
    'api_jsonld_context' => [['shortName', '_format'], ['_controller' => 'api_platform.jsonld.action.context', '_format' => 'jsonld', '_api_respond' => 'true'], ['shortName' => '.+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '.+', 'shortName', true], ['text', '/api/contexts']], [], []],
];