<?php
/**
 * Routing table
 */
Router::add("/home", HomeController::class, "home");
Router::add("/about", HomeController::class, "about");
Router::add("/contact", HomeController::class, "contact");

Router::add("/login", LoginController::class, "login");
Router::add("/login/process", LoginController::class, "login_process");
Router::add("/logout", LoginController::class, "logout");

/** Books */
Router::add("/books", BooksController::class, "index");
Router::add("/books/add", BooksController::class, "add");
Router::add("/books/adding", BooksController::class, "adding");
Router::add("/books/edit", BooksController::class, "edit");
Router::add("/books/editing", BooksController::class, "editing");
Router::add('/books/subcategory', BooksController::class, "view_by_subcategory");
Router::add('/books/search', BooksController::class, "search");

/** Book Instance */
Router::add("/book-instance/adding", BookInstanceController::class, "adding");
Router::add("/book-instance/single", BookInstanceController::class, "single");
Router::add("/book-instance/view-history", BookInstanceController::class, "view_history");

/** Transactions */
Router::add('/transactions', TransactionsController::class, "index");
Router::add('/transactions/show-member-search', TransactionsController::class, "show_member_search");
Router::add('/transactions/search-member-results', TransactionsController::class, "search_member_results");
Router::add('/transactions/add', TransactionsController::class, "add");
Router::add('/transactions/adding', TransactionsController::class, "adding");
Router::add('/transactions/single', TransactionsController::class, "single");
Router::add('/transactions/single/set-as-returned', TransactionsController::class, "single_set_as_returned");
Router::add('/transactions/single/print', TransactionsController::class, "print_single_receipt");

/** Categories */
Router::add('/categories', CategoriesController::class, "index");
Router::add('/categories/adding', CategoriesController::class, "adding");
Router::add('/categories/edit', CategoriesController::class, "edit");
Router::add('/categories/editing', CategoriesController::class, "editing");

/** Authors */
Router::add('/authors', AuthorsController::class, "index");
Router::add('/api/add_author', AuthorsApiController::class, "add_author");

/** Members */
Router::add('/members', MembersController::class, 'index');
Router::add('/members/add', MembersController::class, 'add');
Router::add('/members/adding', MembersController::class, 'adding');
Router::add('/members/edit', MembersController::class, 'edit_member');
Router::add('/members/editing', MembersController::class, 'editing_member');

Router::add('/members/department', MembersController::class, 'view_by_department');
Router::add('/departments/adding', DepartmentsController::class, 'adding');


/** Subcategories */
Router::add('/subcategories', CategoriesController::class, "view_subcategories");
Router::add('/subcategory/add', CategoriesController::class, "add_subcategory");
Router::add('/subcategory/adding', CategoriesController::class, "adding_subcategory");
Router::add('/subcategory/edit', CategoriesController::class, "edit_subcategory");
Router::add('/subcategory/editing', CategoriesController::class, "editing_subcategory");

Router::add('/api/get_subcategory', CategoriesApiController::class, "get_subcategory");
Router::add('/api/edit_subcategory', CategoriesApiController::class, "edit_subcategory");

/** Test Routes */
Router::add('/test', "TestController", "test");
Router::add('/test/image_up', "TestController", "upload_image");
Router::add('/test/uploading_image', "TestController", "uploading_image");
Router::add('/test/session_init', "TestController", "session_init");
Router::add('/test/session_view', "TestController", "session_view");


Router::add('/api/get_subcategories', "ApiCallsController", "get_subcategories_by_category_name");
Router::add('/api/get_author_by_name', "ApiCallsController", "get_author_by_name");
Router::add('/api/json_get_authors', "ApiCallsController", "json_get_authors");
Router::add('/api/add_author', "ApiCallsController", "add_author");
Router::add('/api/get_author_by_id', "ApiCallsController", "get_author_by_id");
Router::add('/api/update_author', "ApiCallsController", "update_author");