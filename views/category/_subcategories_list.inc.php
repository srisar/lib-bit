<div class="card">

    <div class="card-header">
        <?php HtmlHelper::renderCardHeader("Subcategories in {$selected_category}"); ?>
    </div>

    <div class="card-body">


        <div class="mb-3">

            <form class="form" action="<?= App::createURL('/subcategory/adding') ?>" method="get">
                <?php View::renderErrorMessages(Subcategory::KEY_ERROR); ?>
                <input type="hidden" name="category_id" value="<?= $selected_category->id ?>">

                <div class="input-group">
                    <input class="form-control" type="text" name="subcategory_name" required>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Add</button>
                    </div>
                </div>
            </form>

        </div>


        <?php if (!empty($subcategories)): ?>

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Subcategories</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($subcategories as $subcategory): ?>
                    <tr>
                        <td>
                            <a href="#" class="subcat_item" data-id="<?= $subcategory->id ?>"><?= $subcategory ?></a>
                        </td>
                        <td>
                            <a href="<?= App::createURL('/books/subcategory', ['subcat_id' => $subcategory->id]) ?>" class="btn btn-sm btn-success">
                                View Books
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>

        <?php endif; ?>
    </div>

</div>
