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

    /*
    * Determine the url parts to these example files.
    */
    $protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
    $hostname = $_SERVER['HTTP_HOST'];
    $path = dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);

    /*
    * Generate a unique order id for this example. It is important to include this unique attribute
    * in the redirectUrl (below) so a proper return page can be shown to the customer.
    */
    $orderId = time();
    $_SESSION['order_id'] = $orderId;


    //checkout form posts

    $subtotal = $_SESSION['subtotal'];
    $products_in_cart = $_SESSION['products_in_cart'];

    $first_name = $_SESSION["first_name"];
    $last_name = $_SESSION["last_name"];
    $street_name = $_SESSION["street_name"];
    $street_number = $_SESSION["street_number"];
    $street_addons = $_SESSION["street_addons"];
    $zip_code = $_SESSION["zip_code"];
    $city = $_SESSION["city"];
    $country = $_SESSION["country"];
    $phone_number = $_SESSION["phone_number"];
    $mail_address = $_SESSION["mail_address"];

//    $first_name = $_POST['first_name'];
//    $last_name = $_POST['last_name'];
//    $company_name = $_POST['company_name'];
//    $street_name = $_POST['street_name'];
//    $street_number = $_POST['street_number'];
//    $street_addons = $_POST['street_addons'];
//    $zip_code = $_POST['zip_code'];
//    $city = $_POST['city'];
//    $phone_number = $_POST['phone_number'];
//    $mail_address = $_POST['mail_address'];

    $full_address = $street_name . " " . $street_number;
    $payment_status = "open";

    $products = $_SESSION['products'];

    $total = 0;
    $shipping_price_raw = $_SESSION["shipping_price"];
    $shipping_price = number_format($shipping_price_raw, 2, '.', '');
    foreach ($products as $product) {
        $item_id = $product['id'];
        $item_name = $product['name'];
        $item_img = $product['img'];
        $item_description = $product['desc'];
        $item_quantity = $products_in_cart[$product['id']];

        $btw = "21.00";
        $btw_procent = "121.00";

        $item_price = number_format($product['price'], 2, '.', '');
        $total_amount = number_format($item_price * $item_quantity, 2, '.', '');


        $total_vat_amount = number_format($total_amount * ($btw / $btw_procent), 2, '.', '');

        $total_vat_amount_shipping = number_format($shipping_price * ($btw / $btw_procent), 2, '.', '');

        $total += $total_amount;


        $lines[] = [
            "name" => "$item_name",
            "sku" => $item_id,
            "productUrl" => "https://" . $hostname . $path . "/index.php?page=product&id=" . $item_id,
            "imageUrl" => "https://" .$hostname . $path . '/assets/img/' . $item_img,
            "metadata" => [
                "order_id" => $orderId,
                "description" => $item_description
            ],
            "quantity" => $item_quantity,
            "vatRate" => $btw,
            "unitPrice" => [
                "currency" => "EUR",
                "value" => "$item_price"
            ],
            "totalAmount" => [
                "currency" => "EUR",
                "value" => "$total_amount"
            ],
            "vatAmount" => [
                "currency" => "EUR",
                "value" => "$total_vat_amount"
            ]
        ];
    }

    $total_with_shipping = number_format($total + $shipping_price, 2, '.', '');

    $lines[] = [
        "type" => "shipping_fee",
        "name" => "shipping",
        "quantity" => "1",
        "vatRate" => $btw,
        "unitPrice" => [
            "currency" => "EUR",
            "value" => "$shipping_price"
        ],
        "totalAmount" => [
            "currency" => "EUR",
            "value" => "$shipping_price"
        ],
        "vatAmount" => [
            "currency" => "EUR",
            "value" => $total_vat_amount_shipping
        ]
    ];
//    print_r($lines);

    /*
    * Payment parameters:
    *   amount        Amount in EUROs. This example creates a € 10,- payment.
    *   description   Description of the payment.
    *   redirectUrl   Redirect location. The customer will be redirected there after the payment.
    *   webhookUrl    Webhook location, used to report when the payment changes state.
    *   metadata      Custom metadata that is stored with the payment.
    */
    $order = $mollie->orders->create([
        "amount" => [
            "value" => "$total_with_shipping",
            "currency" => "EUR"
        ],
        "billingAddress" => [
            "streetAndNumber" => "$full_address",
            "postalCode" => "$zip_code",
            "city" => "$city",
            "country" => "NL",
            "givenName" => "$first_name",
            "familyName" => "$last_name",
            "email" => "$mail_address",
            "phone" => "+31600000000"
        ],
        "shippingAddress" => [
            "streetAndNumber" => "$full_address",
            "postalCode" => "$zip_code",
            "city" => "$city",
            "country" => "NL",
            "givenName" => "$first_name",
            "familyName" => "$last_name",
            "email" => "$mail_address",
        ],
        "metadata" => [
            "order_id" => $orderId,
            "telefoon_nummer" => $phone_number,
            "land" => $country,
            "straat_toevoegingen" => $street_addons
        ],
        "locale" => "nl_NL",
        "orderNumber" => \strval($orderId),
//        "redirectUrl" => "https://9c3ef8965f14.ngrok.io/clean-screen.nl/index.php?page=mollie_payment",
        "redirectUrl" => "	https://0ee94903cb34.ngrok.io/clean-screen.nl/index.php?page=mollie_payment_webhook_verification",
//        "redirectUrl" => "{$protocol}://{$hostname}{$path}/orders/return.php?order_id={$orderId}",
        "webhookUrl" => "	https://0ee94903cb34.ngrok.io/clean-screen.nl/index.php?page=mollie_payment_webhook_verification",
//        "webhookUrl" => "{$protocol}://{$hostname}{$path}/orders/webhook.php",
        "lines" =>
            $lines
    ]);

//    print_r($order);

    $_SESSION['tr_payment_id'] = $order->id;

    /*
    * In this example we store the order with its payment status in a database.
    */
    $stmt = $pdo->prepare('INSERT INTO transactions VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
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
        $_POST['phone_number'],
        "netherlands"
    ]);

    /*
    * Send the customer off to complete the payment.
    * This request should always be a GET, thus we enforce 303 http response code
    */
    header("Location: " . $order->getCheckoutUrl(), true, 303);
} catch (ApiException $e) {
    header("Location: " . "index.php", true, 303);
//    echo "API call failed: " . htmlspecialchars($e->getMessage());
}

