<?php include_once "views/_header.php" ?>

    <div class="container-fluid">

        <form action="<?= App::create_url('/test/uploading_image') ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image">
            </div>

            <div><button type="submit">Upload</button></div>

        </form>


    </div><!--.container-->

<?php include_once "views/_footer.php" ?>