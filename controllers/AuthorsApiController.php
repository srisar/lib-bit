<?php


class AuthorsApiController
{

    public function add_author()
    {

        try {

            $json = [
                "result" => false,
                "author" => null,
                "errors" => ""
            ];

            $request = new Request();

            $author_name = $request->getParams()->getString("author_name");
            $author_email = $request->getParams()->getString("author_email");

            if (empty(Author::select_by_name($author_name))) {
                // author name doesnt exist. proceed to add

                $author = new Author();
                $author->full_name = $author_name;
                $author->email = $author_email;

                if ($author->insert()) {

                    $inserted_id = Author::get_last_insert_id();

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