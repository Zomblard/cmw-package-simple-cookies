<?php

namespace CMW\Controller\SimpleCookies\Admin;

use CMW\Controller\users\UsersController;
use CMW\Manager\Cache\SimpleCacheManager;
use CMW\Manager\Filter\FilterManager;
use CMW\Manager\Flash\Alert;
use CMW\Manager\Flash\Flash;
use CMW\Manager\Lang\LangManager;
use CMW\Manager\Package\AbstractController;
use CMW\Manager\Router\Link;
use CMW\Manager\Views\View;
use CMW\Model\SimpleCookies\SimpleCookiesModel;
use CMW\Utils\Redirect;
use JetBrains\PhpStorm\NoReturn;
use function is_null;

/**
 * Class: @SimpleCookiesAdminController
 * @package SimpleCookies
 * @author Overheat Studio
 * @version 1.0
 */
class SimpleCookiesAdminController extends AbstractController
{
    #[Link('/cookies', Link::GET, [], '/cmw-admin')]
    private function simpleCookiesManage(): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'simplecookies.manage');

        $settings = SimpleCookiesModel::getInstance()->getSettings();

        View::createAdminView('SimpleCookies', 'manage')
            ->addScriptBefore('Admin/Resources/Vendors/Tinymce/tinymce.min.js',
                'Admin/Resources/Vendors/Tinymce/Config/full.js')
            ->addVariableList(['settings' => $settings])
            ->view();
    }

    #[NoReturn] #[Link('/cookies', Link::POST, [], '/cmw-admin')]
    private function simpleCookiesManagePost(): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'simplecookies.manage');

        $bannerTitle = FilterManager::filterInputStringPost('banner_title');
        $bannerText = FilterManager::filterInputStringPost('banner_text', 65535);
        $pageContent = FilterManager::filterInputStringPost('page_content', null);

        $updatedConfig = SimpleCookiesModel::getInstance()->updateSettings($bannerTitle, $bannerText, $pageContent);

        if (is_null($updatedConfig)) {
            Flash::send(
                Alert::ERROR,
                LangManager::translate('core.toaster.error'),
                LangManager::translate('simplecookies.errors.update'),
            );

            Redirect::redirectPreviousRoute();
        }

        //Update Cache
        SimpleCacheManager::storeCache(
            $updatedConfig->toJson(),
            'settings',
            'SimpleCookies'
        );

        Flash::send(
            Alert::SUCCESS,
            LangManager::translate('core.toaster.success'),
            LangManager::translate('core.toaster.config.success'),
        );

        Redirect::redirectPreviousRoute();
    }


}