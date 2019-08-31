<?php
/**
 * Routing table
 */
Router::add("/home", "HomeController", "home");
Router::add("/about", "HomeController", "about");
Router::add("/contact", "HomeController", "contact");

/** Books */
Router::add("/books", "BookController", "index");
Router::add("/books/add", "BookController", "add");
Router::add("/books/adding", "BookController", "adding");
Router::add("/books/edit", "BookController", "edit");
Router::add("/books/editing", "BookController", "editing");
Router::add('/books/subcategory', BookController::class, "view_by_subcategory");

/** Book Instance */
Router::add("/books/instance/adding", BookInstanceController::class, "adding");

/** Transactions */
Router::add('/transactions/members/search', TransactionsController::class, "show_search");
Router::add('/transactions/members/results', TransactionsController::class, "search_results");
Router::add('/transactions/add', TransactionsController::class, "add");
Router::add('/transactions/adding', TransactionsController::class, "adding");

/** Categories */
Router::add('/categories', "CategoryController", "index");
Router::add('/categories/add', "CategoryController", "add");
Router::add('/categories/adding', "CategoryController", "adding");
Router::add('/categories/edit', "CategoryController", "edit");
Router::add('/categories/editing', "CategoryController", "editing");

/** Members */
Router::add('/members', 'MemberController', 'index');
Router::add('/members/add', 'MemberController', 'add');
Router::add('/members/adding', 'MemberController', 'adding');
Router::add('/members/edit', 'MemberController', 'edit_member');
Router::add('/members/editing', 'MemberController', 'editing_member');

Router::add('/members/department', 'MemberController', 'view_by_department');


/** Subcategories */
Router::add('/subcategories', "CategoryController", "view_subcategories");
Router::add('/subcategories/add', "CategoryController", "add_subcategory");
Router::add('/subcategories/adding', "CategoryController", "adding_subcategory");
Router::add('/subcategories/edit', "CategoryController", "edit_subcategory");
Router::add('/subcategories/editing', "CategoryController", "editing_subcategory");

/** Test Routes */
Router::add('/test', "TestController", "test");
Router::add('/test/image_up', "TestController", "upload_image");
Router::add('/test/uploading_image', "TestController", "uploading_image");


Router::add('/api/get_subcategories', "ApiController", "get_subcategories_by_category_name");