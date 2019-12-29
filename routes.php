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
Router::add('/transactions/filter', TransactionsController::class, "actionFilterTransactions");


/** Categories */
Router::add('/categories', CategoriesController::class, "viewCategories");
Router::add('/categories/adding', CategoriesController::class, "actionAddingCategory");
//Router::add('/categories/edit', CategoriesController::class, "viewEditCategory"); // to be deleted
Router::add('/categories/editing', CategoriesController::class, "actionEditingCategory");


/** Subcategories */
Router::add('/subcategories', CategoriesController::class, "viewSubcategories");
Router::add('/subcategories/adding', CategoriesController::class, "actionAddingSubcategory");
Router::add('/subcategories/editing', CategoriesController::class, "actionEditingSubcategory");
Router::add('/subcategories/single', CategoriesController::class, "actionSingleSubcategory");



/** Authors */
Router::add('/authors', AuthorsController::class, "viewAuthors");
Router::add('/authors/adding', AuthorsController::class, "actionAddingAuthor");
Router::add('/authors/editing', AuthorsController::class, "actionEditingAuthor");
Router::add('/authors/single', AuthorsController::class, "actionGetSingleAuthor");



/** Members */
Router::add('/members', MembersController::class, 'viewMembers');
Router::add('/members/adding', MembersController::class, 'actionAddingMember');
Router::add('/members/edit', MembersController::class, 'viewEditMember');
Router::add('/members/editing', MembersController::class, 'actionEditingMember');

Router::add('/members/department', MembersController::class, 'viewMembersByDepartment');
Router::add('/departments/adding', DepartmentsController::class, 'actionAddingDepartment');


/** Test Routes */
Router::add('/test', "TestController", "test");
Router::add('/test/ajax', "TestController", "viewAjax");


/** API Calls for AJAX */
