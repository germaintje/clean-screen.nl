<?php
$to = $email;
$subject = "Bedankt voor je bestelling met bestelnummer [" . $id . "]";


$message = "";
$message .= "
<div style='width: 75%; margin: 0 auto;'>
<h1>Bedankt voor je bestelling!</h1>
<h2>Fijn dat je koos voor Clean-screen.nl</h2>";

$message .= "<h2>Dit heb je Besteld</h2>";

$message .= "<table>";
$message .= "<tbody style='border: 1px solid black;'>";
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
        $message .= "<td>$imageUrl_html</td>";
        $message .= "<td>$productUrl_html </td>";
//        $message .= "<td>€" . decimal($line_UnitPrice, ',', '.') . "</td>";
        $message .= "<td>$line_Quantity </td>";
//        $message .= "<td>€" . decimal($discount_amount, ',', '.') . "</td>";
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
$message .= "<tr style='border: 1px solid black;'>";
$message .= "<td></td>";
$message .= "<td></td>";
$message .= "<td><b>Subtotal:</b></td>";
$message .= "<td>€" . decimal($lines_Subtotal, ',', '.') . "</td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<td></td>";
$message .= "<td></td>";
$message .= "<td><b>verzendkosten:</b></td>";
$message .= "<td>€" . decimal($shipping_fee, ',', '.') . "</td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<td></td>";
$message .= "<td></td>";
$message .= "<td><b>Kortingscode: $coupon_name </b></td>";
$message .= "<td>-€" . decimal($coupon_discount, ',', '.') . "</td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<td></td>";
$message .= "<td></td>";
$message .= "<td><b>Totaal:</b></td>";
$message .= "<td>€" . decimal($amount, ',', '.') . "</td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<td colspan='4' style='text-align: center;'>Wil je je bestelling bekijken klik dan <a href='clean-screen.nl/index.php?order=$order_id'>hier.</a></td>";
$message .= "</tr>";
$message .= "</tbody>";
$message .= "</table>";

$message .= "
<h2>Details over je bestelling</h2>
<div class='col-12'>
<h4>Factuur- en bezorgadres</h4>
<span>$first_name $last_name</span><br>
<span>$address</span><br>
<span>$zipcode $city</span><br>
<span>$country</span><br>
</div>
";

$message .= "
<h3>Hoe nu verder</h3>
<p>Je krijgt een mail zodra we je artikelen verzenden.</p>
";


// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: clean-screen@no-reply.com' . "\r\n";

mail($to, $subject, $message, $headers);
