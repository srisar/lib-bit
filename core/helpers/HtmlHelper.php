<?php


class HtmlHelper
{

    public static function render_card_header($title = "Card Title")
    {

        ?>
            <span class="mb-0 font-weight-bold card-header-text"><?= $title ?></span>
        <?php

    }

}