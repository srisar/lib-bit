<?php include_once "views/_header.php" ?>

<?php

/** @var Subcategory $subcategory */
$subcategory = View::getData('subcategory');

$all_subcategories = $subcategory->getCategory()->getAllSubcategories();

?>


<div class="container">

  <div class="row mb-3">
    <div class="col text-center">
      <h1 class="text-center">Modify <?= $subcategory ?> in <?= $subcategory->getCategory() ?></h1>
    </div>
  </div><!--.row-->

  <div class="row justify-content-center mb-3">
    <div class="col-6">

      <?php View::renderErrorMessages() ?>

      <form action="<?= App::createURL('/subcategories/editing') ?>" method="get">

        <input type="hidden" name="subcat_id" value="<?= $subcategory->id ?>">

        <div class="form-group">
          <label>Subcategory Name</label>
          <input class="form-control" type="text" name="subcategory_name" value="<?= $subcategory->subcategory_name ?>"
                 required>
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>

      </form>

    </div>
  </div><!-- .row -->

  <div class="row justify-content-center">

    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <h3 class="m-0">Subcategories in <?= $subcategory->getCategory() ?></h3>
        </div>

        <div class="card-body p-1">

          <ul class="list-group">
            <?php foreach ($all_subcategories as $subcategory): ?>
              <li class="list-group-item"><?= $subcategory ?></li>
            <?php endforeach; ?>
          </ul>

        </div>

      </div>
    </div>

  </div>


</div>

<?php include_once "views/_footer.php" ?>


