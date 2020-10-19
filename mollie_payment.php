<?php
/*
* How to prepare a new payment with the Mollie API.
*/

//use Mollie\Api\Exceptions\ApiException;
namespace _PhpScoper5f8847d7a6e47;

try {

    /*
    * Initialize the Mollie API library with your API key.
    *
    * See: https://www.mollie.com/dashboard/settings/profiles
    */
    require "./initialize.php";
    //checkout form posts

//    $subtotal = $_SESSION['subtotal'];
//    $item_id = $_SESSION['item_id'];
//    $item_quantity = $_SESSION["item_quantity"];

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $company_name = $_POST['company_name'];
    $street_name = $_POST['street_name'];
    $street_number = $_POST['street_number'];
    $street_addons = $_POST['street_addons'];
    $zip_code = $_POST['zip_code'];
    $city = $_POST['city'];
    $phone_number = $_POST['phone_number'];
    $mail_address = $_POST['mail_address'];

    $full_address = $street_name . " " . $street_number;
    $payment_status = "open";

    $products = $_SESSION['products'];

    foreach ($products as $product) {
        $item_id = $product['id'];
        $item_price = $product['price'];
        $item_quantity = $product['quantity'];
        $item_img = $product['img'];
    }
    var_dump($products);


    /*
    * Generate a unique order id for this example. It is important to include this unique attribute
    * in the redirectUrl (below) so a proper return page can be shown to the customer.
    */
    $orderId = time();
    $_SESSION['order_id'] = $orderId;
    /*
    * Determine the url parts to these example files.
    */
    $protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
    $hostname = $_SERVER['HTTP_HOST'];
    $path = dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);

    /*
    * Payment parameters:
    *   amount        Amount in EUROs. This example creates a € 10,- payment.
    *   description   Description of the payment.
    *   redirectUrl   Redirect location. The customer will be redirected there after the payment.
    *   webhookUrl    Webhook location, used to report when the payment changes state.
    *   metadata      Custom metadata that is stored with the payment.
    */

//    $payment = $mollie->payments->create([
//        "amount" => [
//            "currency" => "EUR",
//            "value" => "$subtotal"
//        ],
//        "description" => "Order #{$orderId}",
//        "redirectUrl" => "http://667e1a07a81e.ngrok.io/rainbuster.shop/index.php?page=02-webhook-verification",
////        "redirectUrl" => "{$protocol}://{$hostname}{$path}/index.php?page=home",
//        "webhookUrl" =>  "http://667e1a07a81e.ngrok.io/rainbuster.shop/index.php?page=02-webhook-verification",
////        "webhookUrl" => "{$protocol}://{$hostname}{$path}/mollie_payment_webhook_verification.php",
//        "metadata" => [
//            "order_id" => $orderId,
//            "full_address" => $full_address,
//        ],
//    ]);

    $order = $mollie->orders->create([
        "amount" => [
            "value" => "$subtotal",
            "currency" => "EUR"
        ],
        "billingAddress" => [
            "streetAndNumber" => "$full_address",
            "postalCode" => "$zip_code",
            "city" => "$city",
            "country" => "nl",
            "firstName" => "$first_name",
            "lastName" => "$last_name",
            "email" => "$mail_address",
            "phoneNumber" => "$phone_number"
        ],
        "shippingAddress" => [
            "streetAndNumber" => "$full_address",
            "postalCode" => "$zip_code",
            "city" => "$city",
            "country" => "nl",
        ],
        "metadata" => [
            "order_id" => $orderId
        ],
        "locale" => "nl_NL",
        "orderNumber" => \strval($orderId),
        "redirectUrl" => "http://667e1a07a81e.ngrok.io/rainbuster.shop/index.php?page=mollie_payment",
//        "redirectUrl" => "http://667e1a07a81e.ngrok.io/rainbuster.shop/index.php?page=mollie_payment_webhook_verification",
//        "redirectUrl" => "{$protocol}://{$hostname}{$path}/orders/return.php?order_id={$orderId}",
        "webhookUrl" => "http://667e1a07a81e.ngrok.io/rainbuster.shop/index.php?page=02-webhook-verification",
//        "webhookUrl" => "{$protocol}://{$hostname}{$path}/orders/webhook.php",
        "lines" => [
            [
                "product_id" => "1",
                "name" => "LEGO 42083 Bugatti Chiron",
                "productUrl" => "https://shop.lego.com/nl-NL/Bugatti-Chiron-42083",
                "imageUrl" => 'https://sh-s7-live-s.legocdn.com/is/image//LEGO/42083_alt1?$main$',
                "quantity" => 2,
                "vatRate" => "21.00",
                "unitPrice" => [
                    "currency" => "EUR",
                    "value" => "399.00"
                ],
                "totalAmount" => [
                    "currency" => "EUR",
                    "value" => "698.00"
                ]
            ],
        ]
    ]);

//    $_SESSION['tr_payment_id'] = $payment->id;
    $_SESSION['tr_payment_id'] = $order->id;

    /*
    * In this example we store the order with its payment status in a database.
    */
    $stmt = $pdo->prepare('INSERT INTO transactions VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $stmt->execute([
        $orderId,
        $subtotal,
        $payment_status,
        $item_id,
        $item_quantity,
        date('Y-m-d H:i:s'),
        $_POST['mail_address'],
        $_POST['first_name'],
        $_POST['last_name'],
        $full_address,
        $_POST['street_addons'],
        $_POST['city'],
        $_POST['zip_code'],
        $_POST['phone_number']
    ]);

    /*
    * Send the customer off to complete the payment.
    * This request should always be a GET, thus we enforce 303 http response code
    */
    header("Location: " . $order->getCheckoutUrl(), true, 303);
} catch (ApiException $e) {
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}

