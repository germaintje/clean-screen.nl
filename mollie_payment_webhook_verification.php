<?php

//namespace _PhpScoper5f8847d7a6e47;

/*
 * Handle an order status change using the Mollie API.
 */
try {
    /*
     * Initialize the Mollie API library with your API key or OAuth access token.
     */
    require "./initialize.php";
    /*
     * After your webhook has been called with the order ID in its body, you'd like
     * to handle the order's status change. This is how you can do that.
     *
     * See: https://docs.mollie.com/reference/v2/orders-api/get-order
     */

    $order = $mollie->orders->get($_SESSION['tr_payment_id']);
    $orderId = $order->metadata->order_id;
    /*
     * Update the order in the database.
     */

    if ($order->isPaid() || $order->isAuthorized()) {
        /*
         * The order is paid or authorized
         * At this point you'd probably want to start the process of delivering the product to the customer.
         */
        $slc = $pdo->prepare('SELECT * FROM products');
        $slc->execute();
        $products = $slc->fetchAll(PDO::FETCH_ASSOC);
        $order_lines = $order->lines;


        foreach ($order_lines as $lines) {
            $order_product_id = $lines->sku;
            if ($lines->type != "shipping_fee") {
                $quantity_buy = $lines->quantity;
            }

            foreach ($products as $product) {
                $product_id = $product['id'];
                if ($order_product_id == $product_id) {
                    $quantity_left = $product['quantity_item_left'];

                    $quantity_item_left = $quantity_left - $quantity_buy;

                    $stmt = $pdo->prepare('UPDATE products SET quantity_item_left = ? WHERE id = ?');
                    $stmt->execute([
                        $quantity_item_left,
                        $id = $order_product_id,
                    ]);

                }
            }
        }

        $email = $order->shippingAddress->email;

        $to = $email;
        $subject = "Bestelling [" . $order_id . "]";

        $message = "
<html>
<head>
    <title>Bestelling[ $order_id ]</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
<table>
    <tr>
        <th>Firstname</th>
        <th>Lastname</th>
    </tr>
    <tr>
        <td>John</td>
        <td>Doe</td>
    </tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers .= 'From: clean-screen@no-reply.com' . "\r\n";

        mail($to, $subject, $message, $headers);

        session_destroy();
        header("Location: " . "index.php?page=order&id=$order->id", true, 303);

    } elseif ($order->isCanceled()) {
        /*
         * The order is canceled.
         */
        header("Location: " . "index.php", true, 303);
    } elseif ($order->isExpired()) {
        /*
         * The order is expired.
         */
        header("Location: " . "index.php?page=checkout", true, 303);
    } elseif ($order->isCompleted()) {
        /*
         * The order is completed.
         */
    } elseif ($order->isPending()) {
        /*
         * The order is pending.
         */
    } else {
        header("Location: " . "index.php?page=checkout", true, 303);
    }

    $stmt = $pdo->prepare('UPDATE transactions SET payment_status = ? WHERE order_id = ?');
    $stmt->execute([
        $payment_status = "paid",
        $orderId
    ]);
//    header("Location: " . "index.php?page=cart", true, 303);

} catch (\Mollie\Api\Exceptions\ApiException $e) {
    header("Location: " . "index.php", true, 303);
    echo "API call failed: " . \htmlspecialchars($e->getMessage());
}
