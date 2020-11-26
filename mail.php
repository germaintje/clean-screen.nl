<?php

$to = $email;
$subject = "Bestelling [" . $id . "]";

$message = "";

$message .= "<html>";
$message .= "<head>";
$message .= "<title>Bestelling[ $id ]</title>";
$message .= "</head>";
$message .= "<body>";
$message .= "<h1>Bedankt voor je bestelling!</h1>";
$message .= "<table class=\"table table-bordered table-responsive-sm\">";
                    $message .= "<thead>";
                    $message .= "<tr>";
                        $message .= "<th></th>";
                        $message .= "<th>item</th>";
                        $message .= "<th>prijs</th>";
                        $message .= "<th>aantal</th>";
                        $message .= "<th>Korting</th>";
                        $message .= "<th>totaal</th>";
                    $message .= "</tr>";
                    $message .= "</thead>";
                    $message .= "<tbody>";
                    foreach ($order_lines as $lines) {
                        if ($lines->type != "shipping_fee") {
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
                                $productUrl_html = "<a href=\"$productUrl\">$line_Name</a>";
                            } else {
                                $productUrl = "#";
                                $productUrl_html = "<b>$line_Name:</b>";
                            }

                            if (isset($lines->_links->imageUrl->href)) {
                                $imageUrl = $lines->_links->imageUrl->href;
                                $imageUrl_html = "<img class='img_order' src='$imageUrl'>";
                            } else {
                                $imageUrl = "#";
                                $imageUrl_html = "";
                            }

                            $message .= "<tr>";
                            $message .= "<td>$productUrl_html </td>";
                            $message .= "<td>€" . decimal($line_UnitPrice, ',', '.') . "</td>";
                            $message .= "<td>$line_Quantity </td>";
                            $message .= "<td>€" . decimal($discount_amount, ',', '.') . "</td>";
                            $message .= "<td>€" . decimal($lines_TotalAmount, ',', '.') . "</td>";
                            $message .= "</tr>";

                        } elseif ($lines->type == "shipping_fee") {
                            $shipping_fee = $lines->unitPrice->value;

                            if (isset($lines->discountAmount->value)) {
                                $coupon_discount = $lines->discountAmount->value;
                            } else {
                                $coupon_discount = 0.00;
                            }
                        }
                    }
                    $message .= "<tr>";
                        $message .= "<td></td>";
                        $message .= "<td></td>";
                        $message .= "<td></td>";
                        $message .= "<td><b>Subtotal:</b></td>";
                        $message .= "<td>€" . decimal($lines_Subtotal, ',', '.') . "</td>";
                    $message .= "</tr>";
                    $message .= "<tr>";
                        $message .= "<td></td>";
                        $message .= "<td></td>";
                        $message .= "<td></td>";
                        $message .= "<td><b>verzendkosten:</b></td>";
                        $message .= "<td>€" . decimal($shipping_fee, ',', '.') . "</td>";
                    $message .= "</tr>";
                    $message .= "<tr>";
                        $message .= "<td></td>";
                        $message .= "<td></td>";
                        $message .= "<td></td>";
                        $message .= "<td><b>Kortingscode: $coupon_name </b></td>";
                        $message .= "<td>-€" . decimal($coupon_discount, ',', '.') . "</td>";
                    $message .= "</tr>";
                    $message .= "<tr>";
                        $message .= "<td></td>";
                        $message .= "<td></td>";
                        $message .= "<td></td>";
                        $message .= "<td><b>Totaal:</b></td>";
                        $message .= "<td>€" . decimal($amount, ',', '.') . "</td>";
                    $message .= "</tr>";
                    $message .= "</tbody>";

                $message .= "</table>";

                $message .= "Bekijk je <a href='clean-screen.nl/index.php?order=$order_id'>bestelling</a>.";
$message .= "</body>";
$message .= "</html>";


// Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers .= 'From: clean-screen@no-reply.com' . "\r\n";

        mail($to, $subject, $message, $headers);
