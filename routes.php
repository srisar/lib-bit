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

/** Categories */
Router::add('/categories', CategoriesController::class, "index");
Router::add('/categories/add', CategoriesController::class, "add");
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
Router::add('/subcategories/add', CategoriesController::class, "add_subcategory");
Router::add('/subcategories/adding', CategoriesController::class, "adding_subcategory");
Router::add('/subcategories/edit', CategoriesController::class, "edit_subcategory");
Router::add('/subcategories/editing', CategoriesController::class, "editing_subcategory");

/** Test Routes */
Router::add('/test', "TestController", "test");
Router::add('/test/image_up', "TestController", "upload_image");
Router::add('/test/uploading_image', "TestController", "uploading_image");


Router::add('/api/get_subcategories', "ApiController", "get_subcategories_by_category_name");
Router::add('/api/get_author_by_name', "ApiController", "get_author_by_name");
Router::add('/api/json_get_authors', "ApiController", "json_get_authors");
Router::add('/api/add_author', "ApiController", "add_author");
Router::add('/api/get_author_by_id', "ApiController", "get_author_by_id");
Router::add('/api/update_author', "ApiController", "update_author");