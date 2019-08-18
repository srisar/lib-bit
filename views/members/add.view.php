<?php include_once "views/_header.php" ?>

<?php
/** @var Department $department */
$department = View::get_data('department');

?>


    <div class="container-fluid">

        <div class="row">
            <div class="col-6">


                <div class="card">
                    <div class="card-header">
                        <?php HtmlHelper::render_card_header('Add a new member') ?>
                    </div>
                    <div class="card-body">

                        <form action="<?= App::createURL('/members/add') ?>" method="post" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label for=""></label>
                                <input type="text">
                            </div>
                            
                        </form>
                        
                    </div>
                </div>


            </div>
        </div>


    </div>

<?php include_once "views/_footer.php" ?>