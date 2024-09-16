<?php

use CMW\Manager\Env\EnvManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Model\Simplecookies\SimpleCookiesModel;

//Import the SimpleCookies settings
$settings = SimpleCookiesModel::getInstance()->getSettings();

?>
<div class="cookies-consent">
    <h1><?= $settings->getBannerTitle() ?></h1>

    <?= $settings->getPageContent() ?>

    <form action="<?= EnvManager::getInstance()->getValue('PATH_URL') . 'api/cookies/consent' ?>" method="post">
        <?php (new SecurityManager())->insertHiddenToken(); ?>
        <button type="submit" name="consent" value="1">OK</button>
    </form>
</div>