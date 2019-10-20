<?php


class CategoriesApiController
{


    public function get_subcategory()
    {

        try {

            $json = [
                "result" => false,
                "data" => null,
                "error" => null
            ];

            $request = new Request();

            $id = $request->getParams()->getInt("id");

            $subcategory = Subcategory::select($id);

            if (!empty($subcategory)) {

                $json['data'] = $subcategory;
                $json['result'] = true;

                echo json_encode($json);
                return;

            } else {

                $json['result'] = false;
                $json['error'] = "Subcategory not found!";
                echo json_encode($json);
                return;

            }


        } catch (Exception $exception) {
            AppExceptions::showExceptionView($exception->getMessage());
        }

    }

    public function edit_subcategory()
    {

        try {

            $json = [
                "result" => false,
                "data" => null,
                "error" => null
            ];

            $request = new Request();

            $id = $request->getParams()->getInt("id");
            $subcategory_name = $request->getParams()->getString("subcategory_name");


            $subcat_to_insert = new Subcategory();
            $subcat_to_insert->subcategory_name = $subcategory_name;
            $subcat_to_insert->id = $id;
            $subcat_to_insert->category_id = 1;


            if ($subcat_to_insert->already_exists()) {

                $json['result'] = false;
                $json['error'] = "Subcategory already exist.";
                echo json_encode($json);
                return;

            }


            $subcategory = Subcategory::select($id);

            if (!empty($subcategory)) {


                $subcategory->subcategory_name = $subcategory_name;

                if ($subcategory->update()) {

                    $subcategory = Subcategory::select($id);

                    $json['result'] = true;
                    $json['data'] = $subcategory;

                    echo json_encode($json);
                    return;

                }

            } else {
                $json['result'] = false;
                $json['error'] = "Subcategory not found!";
                echo json_encode($json);
                return;
            }


        } catch (Exception $exception) {
            AppExceptions::showExceptionView($exception->getMessage());
        }

    }

}