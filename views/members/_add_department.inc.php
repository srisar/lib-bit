<div class="card mb-3">
    <div class="card-header"> <?php HtmlHelper::renderCardHeader('Add a new department'); ?> </div>
    <div class="card-body p-2">
        <?php View::renderErrorMessages() ?>

        <form class="form" action="<?= App::createURL('/departments/adding') ?>" method="post">

            <div class="input-group">
                <input class="form-control" type="text" name="department_name" required>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Add</button>
                </div>
            </div>

        </form>
    </div>
</div><!--.card-->
