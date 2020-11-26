<?= template_header('Home') ?>
<?php
require "./initialize.php";

if (!isset ($_GET['id'])) {
    header("Location: " . "index.php", true, 303);
}

$order_id = $_GET['id'];
$order = $mollie->orders->get("$order_id", ["embed" => "payments,refunds"]);

$lines_Subtotal = 0;

// order variables
$order_id = $order->id;
$id = $order->orderNumber;
$amount = $order->amount->value;
$address = $order->shippingAddress->streetAndNumber;
$street_addons = $order->metadata->straat_toevoegingen;
$zipcode = $order->shippingAddress->postalCode;
$city = $order->shippingAddress->city;
$country = $order->metadata->land;
$first_name = $order->shippingAddress->givenName;
$last_name = $order->shippingAddress->familyName;
$email = $order->shippingAddress->email;
$phone_number = $order->metadata->telefoon_nummer;
$coupon_name = $order->metadata->kortingscode;
$order_lines = $order->lines;
?>
    <div class="container">
        <div class="row">
            <div class="col-12" id="customers">
                <h4 class="" id="customers">Bestelling [<?= $id ?>]</h4>
                <div class="col-12 col-xl-6">
                    <h5>Gegevens</h5>
                    <span><b>Order: </b><?= $order_id ?></span><br>
                    <span><b>Voornaam: </b><?= $first_name ?></span><br>
                    <span><b>Achternaam: </b><?= $last_name ?></span><br>
                    <span><b>Telefoonnummer: </b><?= $phone_number ?></span><br>
                    <span><b>Email: </b><?= $email ?></span><br>
                    <button onclick="javascript:pdfHTML();" class="btn btn-danger"><i class="far fa-file-pdf"></i> Print
                        als
                        pdf
                    </button>
                </div>

                <div class="col-12 col-xl-6">
                    <h5>Verzendinformatie</h5>
                    <span><b>Land: </b><?= $country ?></span><br>
                    <span><b>Stad: </b><?= $city ?></span><br>
                    <span><b>Straat: </b><?= $address ?></span><br>
                    <span><b>Toevoegingen: </b><?= $street_addons ?></span><br>
                    <span><b>Postcode: </b> <?= $zipcode ?></span><br>
                </div>


                <table class="table table-bordered table-responsive-sm">
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
                            ?>
                            <tr>
                                <!--                            <td>--><? //= $imageUrl_html ?><!--</td>-->
                                <td><?= $productUrl_html ?></td>
                                <td>€<?= decimal($line_UnitPrice, ',', '.'); ?></td>
                                <td><?= $line_Quantity ?></td>
                                <td>€<?= decimal($discount_amount, ',', '.') ?></td>
                                <td>€<?= decimal($lines_TotalAmount, ',', '.'); ?></td>


                            </tr>
                        <?php } elseif ($lines->type == "shipping_fee") {
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
            </div>
        </div>
    </div>


<?= template_footer() ?>

    <script>
        function pdfHTML() {
            var id = "<?php echo $id ?>";
            var pdf = new jsPDF('p', 'pt', 'letter');
            // source can be HTML-formatted string, or a reference
            // to an actual DOM element from which the text will be scraped.
            source = $('#customers')[0];

            // we support special element handlers. Register them with jQuery-style
            // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
            // There is no support for any other type of selectors
            // (class, of compound) at this time.
            specialElementHandlers = {
                // element with id of "bypass" - jQuery style selector
                '#bypassme': function (element, renderer) {
                    // true = "handled elsewhere, bypass text extraction"
                    return true
                }
            };
            margins = {
                top: 20,
                bottom: 60,
                left: 40,
                right: 40,
                width: 522
            };
            // all coords and widths are in jsPDF instance's declared units
            // 'inches' in this case
            pdf.fromHTML(
                source, // HTML string or DOM elem ref.
                margins.left, // x coord
                margins.top, { // y coord
                    'width': margins.width, // max width of content on PDF
                    'elementHandlers': specialElementHandlers
                },

                function (dispose) {
                    var pdfs = "bestelling_" + id + ".pdf";
                    // dispose: object with X, Y of the last line add to the PDF
                    //          this allow the insertion of new lines after html
                    pdf.save(pdfs);
                }, margins);
        }

    </script>

<?php
for($m = 1; $m == 1; $m++){
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
}

?>
