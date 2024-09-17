<?php

use CMW\Manager\Lang\LangManager;
use CMW\Manager\Security\SecurityManager;

/* @var \CMW\Entity\SimpleCookies\SimpleCookiesSettingsEntity $settings */

$title = LangManager::translate('SimpleCookies.manage.title');
$description = LangManager::translate('SimpleCookies.manage.description');
?>
<h3>
    <i class="fa-solid fa-cookie"></i>
    <?= LangManager::translate('SimpleCookies.manage.title') ?>
</h3>

<form action="" method="post">
    <?php (new SecurityManager())->insertHiddenToken() ?>
    <div class="card mt-3">
        <h4><?= LangManager::translate('SimpleCookies.manage.banner') ?></h4>
        <div>
            <label for="banner_title">
                <?= LangManager::translate('SimpleCookies.manage.bannerTitle') ?>
            </label>
            <input type="text" id="banner_title" name="banner_title" required class="input-sm"
                   placeholder="<?= LangManager::translate('SimpleCookies.manage.bannerTitlePlaceholder') ?>"
                   value="<?= $settings->getBannerTitle() ?>">
        </div>
        <div>
            <label for="banner_text">
                <?= LangManager::translate('SimpleCookies.manage.bannerText') ?>
            </label>
            <textarea id="banner_text" class="tinymce" name="banner_text"
                      data-tiny-height="100"><?= $settings->getBannerText() ?></textarea>
        </div>
    </div>
    <div class="mt-3 card">
        <h4><?= LangManager::translate('SimpleCookies.manage.cookiesPage') ?></h4>
        <label for="page_content"></label>
        <textarea id="page_content" class="tinymce" name="page_content"
                  data-tiny-height="700"><?= $settings->getPageContent() ?></textarea>
    </div>

    <button type="submit" class="btn-primary mt-4 loading-btn btn-center"
            data-loading-btn="<?= LangManager::translate('core.btn.saving') ?>">
        <?= LangManager::translate('core.btn.save') ?>
    </button>
</form>