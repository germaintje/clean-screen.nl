<?php

//use Mollie\Api\MollieApiClient;
//
///*
// * Make sure to disable the display of errors in production code!
// */
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//
//require_once __DIR__ . "./vendor/autoload.php";
//
///*
// * Initialize the Mollie API library with your API key.
// *
// * See: https://www.mollie.com/dashboard/settings/profiles
// */
//$mollie = new MollieApiClient();
//$mollie->setApiKey("test_FfyaVfT2fEgM4Qe5fBSbgynGGAgNr6");

namespace _PhpScoper5f8847d7a6e47;

/*
 * Make sure to disable the display of errors in production code!
 */
\ini_set('display_errors', 1);
\ini_set('display_startup_errors', 1);
\error_reporting(\E_ALL);
require_once __DIR__ . "./vendor/autoload.php";
/*
 * Initialize the Mollie API library with your API key.
 *
 * See: https://www.mollie.com/dashboard/developers/api-keys
 */
$mollie = new \Mollie\Api\MollieApiClient();
$mollie->setApiKey("test_FfyaVfT2fEgM4Qe5fBSbgynGGAgNr6");
