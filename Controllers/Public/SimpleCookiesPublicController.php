<?php

namespace CMW\Controller\SimpleCookies\Public;

use CMW\Manager\Package\AbstractController;
use CMW\Manager\Router\Link;
use CMW\Manager\Views\View;
use CMW\Model\SimpleCookies\SimpleCookiesModel;
use CMW\Utils\Redirect;
use function error_log;

/**
 * Class: @SimpleCookiesPublicController
 * @package SimpleCookies
 * @author Overheat Studio
 * @version 1.0
 */
class SimpleCookiesPublicController extends AbstractController
{
    #[Link('/', Link::GET, [], '/cookies')]
    private function publicCookiesPage(): void
    {
        $settings = SimpleCookiesModel::getInstance()->getSettings();

        if (!$settings) {
            error_log('SimpleCookies settings not found');
            Redirect::errorPage(404);
        }

        $content = $settings->getPageContent();

        $view = new View('SimpleCookies', 'main');
        $view->addVariableList(['content' => $content]);
        $view->view();
    }


}