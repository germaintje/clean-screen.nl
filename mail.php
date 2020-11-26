<?php

$to = $email;
$subject = "Bestelling [" . $order_id . "]";

$message = "
<html>
<head>
    <title>Bestelling[ $id ]</title>
</head>
<body>
<h1>Bedankt voor je bestelling!</h1>
<table class=\"table table-bordered table-responsive-sm\">
                    <thead>
                    <tr>
                        <!--                    <th></th>-->
                        <th>item</th>
                        <th>prijs</th>
                        <th>aantal</th>
                        <th>Korting</th>
                        <th>totaal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($order_lines as $lines) {
                        if ($lines->type != \"shipping_fee\") {
                            $line_Name = $lines->name;
                            $line_UnitPrice = $lines->unitPrice->value;
                            $line_Quantity = $lines->quantity;
                            if (isset($lines->discountAmount->value)) {
                                $discount_amount = $lines->discountAmount->value;
                            } else {
                                $discount_amount = 0.00;
                            }

                            $lines_TotalAmount = $lines->totalAmount->value;
                            $lines_Subtotal += $lines_TotalAmount;
                            $vatAmount = $lines->vatAmount->value;

                            if (isset($lines->_links->productUrl->href)) {
                                $productUrl = $lines->_links->productUrl->href;
                                $productUrl_html = \"<a href=\\"$productUrl\\">$line_Name</a>\";
                            } else {
                                $productUrl = \"#\";
                                $productUrl_html = \"<b>$line_Name:</b>\";
                            }

                            if (isset($lines->_links->imageUrl->href)) {
                                $imageUrl = $lines->_links->imageUrl->href;
                                $imageUrl_html = \"<img class='img_order' src='$imageUrl'>\";
                            } else {
                                $imageUrl = \"#\";
                                $imageUrl_html = \"\";
                            }
                            ?>
                            <tr>
                                <!--                            <td>--><? //= $imageUrl_html ?><!--</td>-->
                                <td><?= $productUrl_html ?></td>
                                <td>€<?= decimal($line_UnitPrice, ',', '.'); ?></td>
                                <td><?= $line_Quantity ?></td>
                                <td>€<?= decimal($discount_amount, ',', '.') ?></td>
                                <td>€<?= decimal($lines_TotalAmount, ',', '.'); ?></td>


                            </tr>
                        <?php } elseif ($lines->type == \"shipping_fee\") {
                            $shipping_fee = $lines->unitPrice->value;

                            if (isset($lines->discountAmount->value)) {
                                $coupon_discount = $lines->discountAmount->value;
                            } else {
                                $coupon_discount = 0.00;
                            }
                        }
                    } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Subtotal:</b></td>
                        <td>€<?= decimal($lines_Subtotal, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>verzendkosten:</b></td>
                        <td>€<?= decimal($shipping_fee, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Kortingscode: <?= $coupon_name ?></b></td>
                        <td>-€<?= decimal($coupon_discount, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Totaal:</b></td>
                        <td>€<?= decimal($amount, ',', '.'); ?></td>
                    </tr>
                    </tbody>

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
