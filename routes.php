<?php
/**
 * Routing table
 */
Router::add("/", HomeController::class, "home");

/** Login */
Router::add("/login", LoginController::class, "viewLogin", User::ROLE_NONE);
Router::add("/login/process", LoginController::class, "actionProcessLogin", User::ROLE_NONE);
Router::add("/logout", LoginController::class, "actionLogout");


Router::add('/users', UsersController::class, "viewUsers", User::ROLE_ADMIN);
Router::add('/users/add', UsersController::class, "actionAddUser", User::ROLE_ADMIN);


/** Books */
Router::add("/books", BooksController::class, "viewBooks");
Router::add("/books/add", BooksController::class, "viewAddBook");
Router::add("/books/adding", BooksController::class, "actionAddingBook");
Router::add("/books/edit", BooksController::class, "viewEditBook");
Router::add("/books/editing", BooksController::class, "actionEditingBook");
Router::add('/books/subcategory', BooksController::class, "viewBooksBySubcategory");
Router::add('/books/search', BooksController::class, "viewSearchBooks");


/** Book Instance */
Router::add("/book-instance/adding", BookInstanceController::class, "actionAddingBookInstance");
Router::add("/book-instance/view-history", BookInstanceController::class, "viewBookInstanceHistory");


/** Transactions */
Router::add('/transactions', TransactionsController::class, "viewTransactions");
Router::add('/transactions/show-member-search', TransactionsController::class, "viewMemberSearchForTransaction");
Router::add('/transactions/search-member-results', TransactionsController::class, "viewMemberSearchResultsForTransaction");
Router::add('/transactions/add', TransactionsController::class, "viewAddTransaction");
Router::add('/transactions/adding', TransactionsController::class, "actionAddingTransaction");
Router::add('/transactions/single', TransactionsController::class, "viewSingleTransaction");
Router::add('/transactions/single/set-as-returned', TransactionsController::class, "actionSetAsReturned");
Router::add('/transactions/single/print', TransactionsController::class, "actionPrintSingleReceipt");

/** Categories */
Router::add('/categories', CategoriesController::class, "viewCategories");
Router::add('/categories/adding', CategoriesController::class, "actionAddingCategory");
Router::add('/categories/edit', CategoriesController::class, "viewEditCategory");
Router::add('/categories/editing', CategoriesController::class, "actionEditingCategory");


/** Subcategories */
Router::add('/subcategories', CategoriesController::class, "viewSubcategories");
Router::add('/subcategory/adding', CategoriesController::class, "actionAddingSubcategory");
Router::add('/subcategory/editing', CategoriesController::class, "actionEditingSubcategory");

Router::add('/api/get_subcategories', ApiCallsController::class, "get_subcategories_by_category_name");
Router::add('/api/get_subcategory', CategoriesApiController::class, "get_subcategory");
Router::add('/api/edit_subcategory', CategoriesApiController::class, "edit_subcategory");


/** Authors */
Router::add('/authors', AuthorsController::class, "viewAuthors");
Router::add('/api/add_author', AuthorsApiController::class, "actionAddAuthor");

Router::add('/api/get_author_by_name', ApiCallsController::class, "get_author_by_name");
Router::add('/api/json_get_authors', ApiCallsController::class, "json_get_authors");
Router::add('/api/add_author', ApiCallsController::class, "add_author");
Router::add('/api/get_author_by_id', ApiCallsController::class, "get_author_by_id");
Router::add('/api/update_author', ApiCallsController::class, "update_author");


/** Members */
Router::add('/members', MembersController::class, 'viewMembers');
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
