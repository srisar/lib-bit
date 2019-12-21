<?php


class AuthorsController
{

    public function viewAuthors()
    {

        try {

            $authors = Author::selectAll();

            View::setData('authors', $authors);

            include_once "views/authors/authors.view.php";

        } catch (Exception $exception) {
            AppExceptions::showExceptionView($exception->getMessage());
        }

    }

    public function actionAddingAuthor(Request $request)
    {


        $response = new JSONResponse();

        try {

            $author_name = $request->getParams()->getString("author_name");
            $author_email = $request->getParams()->getString("author_email");

            if (empty(Author::selectByName($author_name))) {
                // author name doesnt exist. proceed to add

                $author = new Author();
                $author->full_name = $author_name;
                $author->email = $author_email;

                if ($author->insert()) {

                    echo $response->toJSON();
                    return;


                } else {
                    $response->addError("Error adding new author");
                    echo $response->toJSON();
                    return;
                }

            } else {

                $response->addError(sprintf("Author name (%s) already exists.", $author_name));
                echo $response->toJSON();
                return;
            }

        } catch (Exception $exception) {

            $response->addError($exception->getMessage());
            echo $response->toJSON();
            return;

        }

    }

    public function actionEditingAuthor(Request $request)
    {

        $response = new JSONResponse();

        try {

            $fields = [
                'author_id' => $request->getParams()->getInt('author_id'),
                'author_name' => $request->getParams()->getString('author_name'),
                'author_email' => $request->getParams()->getString('author_email'),
            ];


            $selectedAuthor = Author::select($fields['author_id']);

            if (!empty($selectedAuthor)) {

                $selectedAuthor->full_name = $fields['author_name'];
                $selectedAuthor->email = $fields['author_email'];

                if ($selectedAuthor->update()) {
                    echo $response->toJSON();
                    return;
                } else {
                    $response->addError('Error updating the author');
                    echo $response->toJSON();
                    return;
                }


            } else {
                $response->addError('Invalid author');
                echo $response->toJSON();
                return;
            }


        } catch (AppExceptions $exception) {
            $response->addError($exception->getMessage());
            echo $response->toJSON();
            return;
        }


    }

    public function actionGetSingleAuthor(Request $request)
    {

        $response = new JSONResponse();

        try {

            header('Content-Type: application/json');

            $authorId = $request->getParams()->getInt('author_id');

            $selectedAuthor = Author::select($authorId);

            if (!empty($selectedAuthor)) {
                $response->addData($selectedAuthor);
                echo $response->toJSON();
                return;
            }

            $response->addError("No author found!");
            echo $response->toJSON();
            return;


        } catch (AppExceptions $exception) {
            $response->addError($exception->getMessage());
            echo $response->toJSON();
            return;
        }

    }

}