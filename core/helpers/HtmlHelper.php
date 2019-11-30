<?php


class HtmlHelper
{

    public static function renderCardHeader($title = "Card Title")
    {

        ?>
        <span class="mb-0 font-weight-bold card-header-text"><?= $title ?></span>
        <?php

    }

    public static function renderSelectBox($name, $data, $id = "", $selected_value = null)
    {
        ?>
        <select class="form-control" name="<?= $name ?>" id="<?= $id ?>">
            <?php foreach ($data as $k => $v): ?>
                <?php $selected = $v == $selected_value ? 'selected' : '' ?>
                <option class="" <?= $selected ?> value="<?= $k ?>"><?= $v ?></option>
            <?php endforeach; ?>
        </select>
        <?php
    }

}