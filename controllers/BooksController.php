<?php

use Carbon\Carbon;

class BooksController
{

    public function viewBooks()
    {

        $categories = Category::selectAll();


        $stats = [
            'total_books' => Book::getStatsTotalBooks(),
            'total_book_copies' => BookInstance::getStatsTotalBookInstances(),
            'total_categories' => Category::getStatsTotalCategories(),
            'total_authors' => Author::getStatsTotalAuthors(),
            'total_members' => Member::getStatsTotalMembers(),
            'total_departments' => Department::getStatsTotalDepartments(),
            'monthly_transactions_data' => $this->getMonthOnMonthTransactionsCount()['data'],
            'monthly_transactions_months' => $this->getMonthOnMonthTransactionsCount()['months'],
        ];


        View::setData('categories', $categories);
        View::setData('title', 'All Books');
        View::setData('stats', $stats);

        include "views/books/view_books.view.php";

    }

    public function viewSearchBooks(Request $request)
    {
        try {

            $keyword = $request->getParams()->getString('q');

            if (!empty($keyword)) {
                $books = Book::search($keyword);
                $categories = Category::selectAll();

                View::setData('books', $books);
                View::setData('categories', $categories);
                View::setData('title', sprintf("Search results for → %s", $keyword));
                View::setData('keyword', $keyword);
                include "views/books/books_search.view.php";
            } else {
                App::redirect('/books');
            }

        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }

    public function viewAddBook(Request $request)
    {

        try {

            $fields = [
                'subcat_id' => $request->getParams()->getInt('subcat_id'),
            ];


            $subcategory = Subcategory::select($fields['subcat_id']);
            $category = $subcategory->getCategory();

            View::setData('category', $category);
            View::setData('subcategory', $subcategory);
            View::setData('categories', Category::selectAll());


            include "views/books/books_add.view.php";

        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }

    }

    public function actionAddingBook(Request $request)
    {

        try {


            $fields = [
                'cat_id' => $request->getParams()->getInt('cat_id'),
                'subcat_id' => $request->getParams()->getInt('subcat_id'),
                'title' => $request->getParams()->getString('title'),
                'author_id' => $request->getParams()->getInt('author_id'),
                'page_count' => $request->getParams()->getInt('page_count'),
                'isbn' => $request->getParams()->getString('isbn'),
                'book_overview' => $request->getParams()->getString('book_overview'),
            ];


            if (empty($fields['author_id'])) {
                App::redirect('/books/add', ['subcat_id' => $fields['subcat_id'], 'error' => '1']);
            }


            $book = new Book();
            $book->title = $fields['title'];
            $book->category_id = $fields['cat_id'];
            $book->subcategory_id = $fields['subcat_id'];
            $book->author_id = $fields['author_id'];
            $book->page_count = $fields['page_count'];
            $book->isbn = $fields['isbn'];
            $book->book_overview = $fields['book_overview'];


            if ($book->insert()) {
                $book_id = Book::getLastInsertedID();
                App::redirect('/books/edit', ['id' => $book_id]);
            }


        } catch (AppExceptions $ex) {
            $ex->showMessage();
        }

    }

    public function viewEditBook(Request $request)
    {

        try {

            $id = $request->getParams()->getInt('id');

            $book = Book::select($id);

            $categories = Category::selectAll();

            View::setData('book', $book);
            View::setData('categories', $categories);

            include "views/books/books_edit.view.php";

        } catch (AppExceptions $exception) {
            $exception->showMessage();
        }
    }


    public function actionEditingBook(Request $request)
    {


        try {

            $fields = [
                'id' => $request->getParams()->getInt('id'),
                'title' => $request->getParams()->getString('title'),
                'category_id' => $request->getParams()->getInt('category_id'),
                'subcategory_id' => $request->getParams()->getInt('subcategory_id'),
            ];


            if ($request->hasValidImage()) {


                // 1. image upload enabled.

                $uploaded_image = new UploadedFile($request->getFiles()->get('image'));

                // check uploaded image is valid before calling the saveFile()

                if (!$uploaded_image->has_error()) {
                    if ($uploaded_image->save_file(BOOK_COVERS_UPLOAD_PATH)) {

                        $img_resize = new ImageProcessor($uploaded_image->get_full_uploaded_file_path());
                        $img_resize->resizeExact(400, 600);
                        $img_resize->saveImage($uploaded_image->get_full_uploaded_file_path());

                        $book = Book::select($fields['id']);
                        $book->title = $fields['title'];
                        $book->category_id = $fields['category_id'];
                        $book->subcategory_id = $fields['subcategory_id'];
                        $book->image_url = $uploaded_image->get_uploaded_file_name();


                        if ($book->update()) {
                            App::redirect('/books/edit?id=' . $fields['id']);
                        }

                    }
                }


            } else {


                // 2. image upload disabled. (default state)
                $book = Book::select($fields['id']);
                $book->title = $fields['title'];
                $book->category_id = $fields['category_id'];
                $book->subcategory_id = $fields['subcategory_id'];

                if ($book->update()) {
                    App::redirect('/books/edit?id=' . $fields['id']);
                }
            }

        } catch (AppExceptions $exception) {
            $exception->showMessage();
        }


    }

    public function viewBooksBySubcategory(Request $request)
    {

        try {
            $field = ['subcat_id' => $request->getParams()->getInt('subcat_id')];

            $books = Book::getAllBySubcategory($field['subcat_id']);

            $categories = Category::selectAll();

            $subcat = Subcategory::select($field['subcat_id']);

            $title = sprintf("%s → %s", $subcat->getCategory(), $subcat->subcategory_name);

            View::setData('books', $books);
            View::setData('categories', $categories);
            View::setData('title', $title);
            View::setData('selected_subcategory', $subcat);

            include "views/books/books_subcategory.view.php";
        } catch (Exception $exception) {
            die($exception->getMessage());
        }

    }

    /**
     * Returns the given number of last months' name and
     * number of transactions as an array
     * @param int $n
     * @return array
     */
    private function getMonthOnMonthTransactionsCount($n = 6)
    {
        $data = [];
        $months = [];

        for ($index = 0; $index < $n; $index++) {

            $now = Carbon::today()->startOfMonth();
            $now->month = $now->month - $index;

            $months[] = $now->monthName;

            $firstDay = $now->startOfMonth()->toDateString();
            $lastDay = $now->endOfMonth()->toDateString();

            $data[] = BookTransaction::getStatsNumberOfTransactions($firstDay, $lastDay);

        }

        return ['months' => $months, 'data' => $data];
    }

}