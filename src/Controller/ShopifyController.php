<?php

namespace App\Controller;

use Pimcore\Controller\FrontendController;
use Shopify\Auth\FileSessionStorage;
use Shopify\Auth\OAuth;
use Shopify\Context;
use Shopify\Utils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopifyController extends FrontendController
{
    //https://admin.shopify.com/oauth/install_custom_app?client_id=0862fb7f05f0eeee19fe931ff6283b31&is_unified_admin_url=true&signature=eyJfcmFpbHMiOnsibWVzc2FnZSI6ImV5SmxlSEJwY21WelgyRjBJam94TmpreU5qSTROekUxTENKd1pYSnRZVzVsYm5SZlpHOXRZV2x1SWpvaWNYVnBZMnR6ZEdGeWRDMWtZamsyTXpBM1lpNXRlWE5vYjNCcFpua3VZMjl0SWl3aVkyeHBaVzUwWDJsa0lqb2lNRGcyTW1aaU4yWXdOV1l3WldWbFpURTVabVU1TXpGbVpqWXlPRE5pTXpFaUxDSndkWEp3YjNObElqb2lZM1Z6ZEc5dFgyRndjQ0lzSW0xbGNtTm9ZVzUwWDI5eVoyRnVhWHBoZEdsdmJsOXBaQ0k2T0RVMk16a3lOalI5IiwiZXhwIjoiMjAyMy0wOC0yOFQxNDozODozNS43NzBaIiwicHVyIjpudWxsfX0%3D--ad8001a8c503d1e1312a764ac2eebc8d9125a7f3
    private const SHOPIFY_API_KEY = '0862fb7f05f0eeee19fe931ff6283b31';
    private const SHOPIFY_API_SECRET = 'd2fb8f8fd11640efe2ac05de47ca4913';
    private const SHOPIFY_APP_SCOPES = ['write_products', 'read_products'];
    private const SHOPIFY_APP_HOST_NAME = 'https://quickstart-db96307b.myshopify.com';

    #[Route('/install', name: 'shopify_install')]
    public function installAction(): JsonResponse
    {
        $this->initContext();

        $returnUrl = OAuth::begin(
            'shopname',
            '/redirect',
            true,
        );

        return new JsonResponse('ok');
    }

    private function initContext()
    {
        Context::initialize(
            apiKey: self::SHOPIFY_API_KEY,
            apiSecretKey: self::SHOPIFY_API_SECRET,
            scopes: self::SHOPIFY_APP_SCOPES,
            hostName: self::SHOPIFY_APP_HOST_NAME,
            sessionStorage: new FileSessionStorage('/tmp/php_sessions'),
            apiVersion: '2023-04',
            isEmbeddedApp: true,
            isPrivateApp: false,
        );
    }
}
