<?php

use CMW\Utils\Website;

/* @var string $content */

Website::setTitle("Cookies");
Website::setDescription("Informations sur les cookies que nous stockons sur le site " . Website::getWebsiteName());

?>

<section class="cookies-container">
    <?= $content ?>
</section>
