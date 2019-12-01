<?php


class AuthorsApiController
{

    public function actionAddAuthor(Request $request)
    {

        try {

            $json = [
                "result" => false,
                "author" => null,
                "errors" => ""
            ];


            $author_name = $request->getParams()->getString("author_name");
            $author_email = $request->getParams()->getString("author_email");

            if (empty(Author::selectByName($author_name))) {
                // author name doesnt exist. proceed to add

                $author = new Author();
                $author->full_name = $author_name;
                $author->email = $author_email;

                if ($author->insert()) {

                    $inserted_id = Author::getLastInsertedID();

                    $author = Author::select($inserted_id);

                    $json["result"] = true;
                    $json["author"] = $author;
                    echo json_encode($json);

                } else {
                    $json["errors"] = "Error inserting author.";
                    echo json_encode($json);
                }

            } else {

                $json["errors"] = "Author name already exist.";
                echo json_encode($json);
            }

        } catch (Exception $exception) {
            AppExceptions::showExceptionView($exception->getMessage());
        }

    }

}