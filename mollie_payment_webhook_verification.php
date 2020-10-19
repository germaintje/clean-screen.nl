<?php
///*
// * Example 2 - How to verify Mollie API Payments in a webhook.
// */
//
//use Mollie\Api\Exceptions\ApiException;
//
//try {
//    /*
//     * Initialize the Mollie API library with your API key.
//     *
//     * See: https://www.mollie.com/dashboard/settings/profiles
//     */
//    require "./initialize.php";
//
//    /*
//     * Retrieve the payment's current state.
//     */
//    $payment = $mollie->payments->get($_SESSION['tr_payment_id']);
//    $orderId = $payment->metadata->order_id;
//    $full_address = $payment->metadata->full_address;
//
//    $payment_status = "open";
//
//    if ($payment->isPaid()) {
//        /*
//         * At this point you'd probably want to start the process of delivering the product to the customer.
//         */
//        $payment_status = "paid";
//        var_dump($full_address);
//    } elseif ($payment->isOpen()) {
//        /*
//         * The payment is open.
//         */
//        $payment_status = "open";
//    } elseif ($payment->isPending()) {
//        /*
//         * The payment is pending.
//         */
//        $payment_status = "pending";
//    } elseif ($payment->isFailed()) {
//        /*
//         * The payment has failed.
//         */
//        $payment_status = "failed";
//    } elseif ($payment->isExpired()) {
//        /*
//         * The payment is expired.
//         */
//        $payment_status = "expired";
//    } elseif ($payment->isCanceled()) {
//        /*
//         * The payment has been canceled.
//         */
//        $payment_status = "canceled";
//    }
//
    /*
 * Update the order in the database.
 */
//    $stmt = $pdo->prepare('UPDATE transactions SET payment_status = ? WHERE order_id = ?');
//    $stmt->execute([
//        $payment_status,
//        $orderId
//    ]);
//
//    session_destroy();
//    header("Location: " . "index.php", true, 303);

//} catch (ApiException $e) {
//    echo "API call failed: " . htmlspecialchars($e->getMessage());
////    var_dump($mollie->payments->get($_POST["id"]));
//}


namespace _PhpScoper5f8847d7a6e47;

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
    } elseif ($order->isCanceled()) {
        /*
         * The order is canceled.
         */
    } elseif ($order->isExpired()) {
        /*
         * The order is expired.
         */
    } elseif ($order->isCompleted()) {
        /*
         * The order is completed.
         */
    } elseif ($order->isPending()) {
        /*
         * The order is pending.
         */
    }

    $stmt = $pdo->prepare('UPDATE transactions SET payment_status = ? WHERE order_id = ?');
    $stmt->execute([
        $payment_status = "paid",
        $orderId
    ]);

    session_destroy();
    header("Location: " . "index.php", true, 303);

} catch (\Mollie\Api\Exceptions\ApiException $e) {
    echo "API call failed: " . \htmlspecialchars($e->getMessage());
}
