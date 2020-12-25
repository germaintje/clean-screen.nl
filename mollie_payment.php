<?php
/*
* How to prepare a new payment with the Mollie API.
*/
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
    $full_address = $street_name . " " . $street_number;
    $payment_status = "open";

    $products = $_SESSION['products'];

    $total = 0;
    $subtotal = 0.00;

    foreach ($products as $product) {
        /**
         * for loop for the discount on every item
         */
        for ($product_count = 1; $product_count <= $products_in_cart[$product['id']]; $product_count++) {
            if ($product_count > $product['discount_first_step']) {
                if ($product_count % $product['discount_steps'] == 0 && $product_count <= $product['max_products']) {
                    $count = $product_count / $product['discount_steps'];
                }
                $korting = ($product['discount_price'] * $product_count) * $count;
            } elseif ($product_count <= $product['discount_first_step']) {
                $korting = 0.00;
            }
            $discount_amount = decimal($korting, '.', '.');
            $prijs = ($product['price'] * $product_count) - $korting;
        }
        $subtotal += $prijs;

        $coupon_price = decimal($_SESSION['discount_price_raw'], '.', '');
        /**
         * the shipping price from a session and set to 2 decimals with a dot seperated
         */
        $shipping_price = decimal($_SESSION['shipping_price'], '.', '');
        $total_amount_shipping = decimal($shipping_price - $coupon_price, '.', '');
        /**
         * all the item info for each order line
         */
        $item_id = $product['id'];
        $item_name = $product['name'];
        $item_img = $product['highlight_img'];
        $item_description = $product['desc'];
        $item_quantity = $products_in_cart[$product['id']];
        $item_price = decimal($product['price'], '.', '');

        /**
         * the btw that you get over the bought items
         */
        $btw = "21.00";
        $btw_procent = "121.00";

        /**
         * total_amount: the total price of each product multiplie with his quantity
         * total_vat_amount: the total amount of the btw for all products
         */
        $total_amount = decimal($prijs, '.', '');
        $total_vat_amount = decimal($total_amount * ($btw / $btw_procent), '.', '');

        /**
         * the total amount of btw of the shipping
         */
        $total_vat_amount_shipping = decimal($total_amount_shipping * ($btw / $btw_procent), '.', '');

        /**
         * the total amount of all products
         */
        $total += $total_amount;

        /**
         * total price of all products with the shipping price included
         */
        $total_with_shipping = decimal((($subtotal + $shipping_price) - $coupon_price), '.', '');


        /**
         * the order lines for each product
         */
        $lines[] = [
            "name" => "$item_name",
            "sku" => $item_id,
            "productUrl" => "https://" . $hostname . $path . "/index.php?page=product&id=" . $item_id,
            "imageUrl" => "https://" . $hostname . $path . '/assets/img/' . $item_img,
            "metadata" => [
                "order_id" => $orderId
            ],
            "quantity" => $item_quantity,
            "vatRate" => $btw,
            "unitPrice" => [
                "currency" => "EUR",
                "value" => "$item_price"
            ],
            "discountAmount" => [
                "currency" => "EUR",
                "value" => "$discount_amount"
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


    /**
     * order line of the shipping cost
     */
    $lines[] = [
        "type" => "shipping_fee",
        "name" => "shipping",
        "quantity" => "1",
        "vatRate" => $btw,
        "unitPrice" => [
            "currency" => "EUR",
            "value" => "$shipping_price"
        ],
        "discountAmount" => [
            "currency" => "EUR",
            "value" => "$coupon_price"
        ],
        "totalAmount" => [
            "currency" => "EUR",
            "value" => "$total_amount_shipping"
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
            "straat_toevoegingen" => $street_addons,
            "totale_korting_kortingscode" => $_SESSION['discount_price_raw'],
            "kortingscode" => $_SESSION['discount_name']
        ],
        "locale" => "nl_NL",
        "orderNumber" => \strval($orderId),
        "redirectUrl" => "{$protocol}://{$hostname}{$path}/index.php?page=mollie_payment_webhook_verification",
        "webhookUrl" => "{$protocol}://{$hostname}{$path}/index.php?page=mollie_payment_webhook_verification",
        "lines" =>
            $lines
    ]);

    $_SESSION['tr_payment_id'] = $order->id;


    header("Location: " . $order->getCheckoutUrl(), true, 303);
} catch (ApiException $e) {
    header("Location: " . "index.php", true, 303);
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}

