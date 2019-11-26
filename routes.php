<?php
/**
 * Routing table
 */
Router::add("/", HomeController::class, "home");

/** Login */
Router::add("/login", LoginController::class, "login", User::ROLE_NONE);
Router::add("/login/process", LoginController::class, "login_process", User::ROLE_NONE);
Router::add("/logout", LoginController::class, "logout");

Router::add('/users', UsersController::class, "manage_users", User::ROLE_ADMIN);
Router::add('/users/add', UsersController::class, "ajax_add_user", User::ROLE_ADMIN);

/** Books */
Router::add("/books", BooksController::class, "view_books");
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


/** Subcategories */
Router::add('/subcategories', CategoriesController::class, "view_subcategories");
Router::add('/subcategory/add', CategoriesController::class, "add_subcategory");
Router::add('/subcategory/adding', CategoriesController::class, "adding_subcategory");
Router::add('/subcategory/edit', CategoriesController::class, "edit_subcategory");
Router::add('/subcategory/editing', CategoriesController::class, "editing_subcategory");

Router::add('/api/get_subcategories', ApiCallsController::class, "get_subcategories_by_category_name");
Router::add('/api/get_subcategory', CategoriesApiController::class, "get_subcategory");
Router::add('/api/edit_subcategory', CategoriesApiController::class, "edit_subcategory");


/** Authors */
Router::add('/authors', AuthorsController::class, "index");
Router::add('/api/add_author', AuthorsApiController::class, "add_author");

Router::add('/api/get_author_by_name', ApiCallsController::class, "get_author_by_name");
Router::add('/api/json_get_authors', ApiCallsController::class, "json_get_authors");
Router::add('/api/add_author', ApiCallsController::class, "add_author");
Router::add('/api/get_author_by_id', ApiCallsController::class, "get_author_by_id");
Router::add('/api/update_author', ApiCallsController::class, "update_author");


/** Members */
Router::add('/members', MembersController::class, 'index');
Router::add('/members/add', MembersController::class, 'add');
Router::add('/members/adding', MembersController::class, 'adding');
Router::add('/members/edit', MembersController::class, 'edit_member');
Router::add('/members/editing', MembersController::class, 'editing_member');

Router::add('/members/department', MembersController::class, 'view_by_department');
Router::add('/departments/adding', DepartmentsController::class, 'adding');


/** Test Routes */
Router::add('/test', "TestController", "test");
Router::add('/test/image_up', "TestController", "upload_image");
Router::add('/test/uploading_image', "TestController", "uploading_image");
Router::add('/test/session_init', "TestController", "session_init");
Router::add('/test/session_view', "TestController", "session_view");

/** API Calls for AJAX */
