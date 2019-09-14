<?php
/**
 * Routing table
 */
Router::add("/home", HomeController::class, "home");
Router::add("/about", HomeController::class, "about");
Router::add("/contact", HomeController::class, "contact");

/** Books */
Router::add("/books", BooksController::class, "index");
Router::add("/books/add", BooksController::class, "add");
Router::add("/books/adding", BooksController::class, "adding");
Router::add("/books/edit", BooksController::class, "edit");
Router::add("/books/editing", BooksController::class, "editing");
Router::add('/books/subcategory', BooksController::class, "view_by_subcategory");

/** Book Instance */
Router::add("/book-instance/adding", BookInstanceController::class, "adding");
Router::add("/book-instance/single", BookInstanceController::class, "single");
Router::add("/book-instance/view-history", BookInstanceController::class, "view_history");

/** Transactions */
Router::add('/transactions/show-member-search', TransactionsController::class, "show_member_search");
Router::add('/transactions/search-member-results', TransactionsController::class, "search_member_results");
Router::add('/transactions/add', TransactionsController::class, "add");
Router::add('/transactions/adding', TransactionsController::class, "adding");
Router::add('/transactions/single', TransactionsController::class, "single");

/** Categories */
Router::add('/categories', CategoriesController::class, "index");
Router::add('/categories/add', CategoriesController::class, "add");
Router::add('/categories/adding', CategoriesController::class, "adding");
Router::add('/categories/edit', CategoriesController::class, "edit");
Router::add('/categories/editing', CategoriesController::class, "editing");

/** Members */
Router::add('/members', MembersController::class, 'index');
Router::add('/members/add', MembersController::class, 'add');
Router::add('/members/adding', MembersController::class, 'adding');
Router::add('/members/edit', MembersController::class, 'edit_member');
Router::add('/members/editing', MembersController::class, 'editing_member');

Router::add('/members/department', MembersController::class, 'view_by_department');


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