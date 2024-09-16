<?php

namespace CMW\Controller\Simplecookies\Api;

use CMW\Controller\Simplecookies\SimpleCookiesController;
use CMW\Manager\Package\AbstractController;
use CMW\Manager\Router\Link;
use CMW\Utils\Redirect;
use JetBrains\PhpStorm\NoReturn;

/**
 * Class: @SimpleCookiesApiController
 * @package SimpleCookies
 * @author Overheat Studio
 * @version 1.0
 */
class SimpleCookiesApiController extends AbstractController
{
    #[NoReturn] #[Link('/consent', Link::POST, [], '/api/cookies')]
    private function consentPost(): void
    {
        if (isset($_POST['consent']) && $_POST['consent'] === '1') {
            SimpleCookiesController::getInstance()->storeClientConsent();
        }

        Redirect::redirectPreviousRoute();
    }
}