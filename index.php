<?php

require "bootstrap.php";

/**
 * Routing table
 */
Router::add("/home", "HomeController", "home");
Router::add("/about", "HomeController", "about");
Router::add("/contact", "HomeController", "contact");

Router::add("/books", "BookController", "index");
Router::add("/books/add", "BookController", "add");
Router::add("/books/adding", "BookController", "adding");
Router::add("/books/edit", "BookController", "edit");
Router::add("/books/editing", "BookController", "editing");

Router::add("/books/instance/adding", BookInstanceController::class, "adding");


Router::add('/transactions/members/search', TransactionsController::class, "show_search");
Router::add('/transactions/members/results', TransactionsController::class, "search_results");
Router::add('/transactions/add', TransactionsController::class, "add");
Router::add('/transactions/adding', TransactionsController::class, "adding");


Router::add('/categories', "CategoryController", "index");
Router::add('/categories/add', "CategoryController", "add");
Router::add('/categories/adding', "CategoryController", "adding");
Router::add('/categories/edit', "CategoryController", "edit");
Router::add('/categories/editing', "CategoryController", "editing");

Router::add('/members', 'MemberController', 'index');

Router::add('/subcategories/add', "CategoryController", "subcat_add");
Router::add('/subcategories/adding', "CategoryController", "subcat_adding");

Router::add('/test', "TestController", "test");


Router::add('/api/get_subcategories', "ApiController", "get_subcategories_by_category_name");

$route_url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/home';

// var_dump($_SERVER);

Router::route($route_url);

//var_dump(App::getAssetsURL());