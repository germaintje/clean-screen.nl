<?php

namespace _PhpScoper5f8847d7a6e47;

/*
 * Make sure to disable the display of errors in production code!
 */
\ini_set('display_errors', 1);
\ini_set('display_startup_errors', 1);
\error_reporting(\E_ALL);
require_once __DIR__ . "./vendor/autoload.php";
/*
 * Initialize the Mollie API library with OAuth.
 *
 * See: https://docs.mollie.com/oauth/overview
 */
$mollie = new \Mollie\Api\MollieApiClient();
$mollie->setAccessToken("access_w3PRcfhUmFpujD5kDkSete7jz82Cby9BMswdmES7");
