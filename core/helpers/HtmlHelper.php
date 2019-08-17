<?php


class HtmlHelper
{

    public static function render_card_header($title = "Card Title")
    {

        ?>
            <h3 class="mb-0"><?= $title ?></h3>
        <?php

    }

}