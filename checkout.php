<?php
//if($payment->getCheckoutUrl() == true){
//    echo "yes";
//}else{
//    echo "no";
//}


echo "verschillende pagina's van mollie<br>";

$protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
$hostname = $_SERVER['HTTP_HOST'];
$path = dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);


$products = $_SESSION['products'];
$subtotal = $_SESSION['subtotal'];
$products_in_cart = $_SESSION['products_in_cart'];
//$product_id = $_SESSION["item_id"];
//$product_quantity = $_SESSION["item_quantity"];

?>

<?= template_header('Winkelwagen') ?>

<div class="row">
    <div class="col-12 no_padding">
        <div class="container">
            <div class="desktop_cart">
                <form action="index.php?page=mollie_payment" method="post">
                    <div class="col-12 col-xl-7">
                        <div class="form-group col-6 no_padding">
                            <label for="first_name">voornaam*</label>
                            <input id="first_name" type="text" class="form-control" name="first_name" required>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="form-group col-6 no_padding">
                            <label for="second_name">achternaam*</label>
                            <input id="second_name" type="text" class="form-control" name="last_name" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company_name">Bedrijfsnaam</label>
                            <input id="company_name" type="text" class="form-control" name="company_name">
                        </div>
                        <div class="form-group col-9 no_padding">
                            <label for="street">Straat*</label>
                            <input id="street" type="text" class="form-control" name="street_name" required>
                        </div>
                        <div class="form-group col-3 no_padding">
                            <label for="street">huisnummer*</label>
                            <input id="street" type="text" class="form-control" name="street_number" required>
                        </div>
                        <div class="form-group">
                            <input id="street" type="text" class="form-control" placeholder="Toevoegingen" name="street_addons">
                        </div>
                        <div class="form-group">
                            <label for="inputZip">Postcode*</label>
                            <input id="inputZip" type="text" class="form-control" name="zip_code" required>
                        </div>
                        <div class="form-group">
                            <label for="city">Plaats*</label>
                            <input id="city" type="text" class="form-control" name="city" required>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Telefoon*</label>
                            <input id="phone_number" type="text" class="form-control" name="phone_number" required>
                        </div>
                        <div class="form-group">
                            <label for="email_adress">E-mailadres*</label>
                            <input id="email_adress" type="email" class="form-control" name="mail_address" required>
                        </div>

                    </div>


                    <div class="col-12 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td>Product</td>
                                    <td>Subtotaal</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (empty($products)): ?>
                                    <tr>
                                        <td colspan="6" style="text-align:center;"><p class="alert alert-danger">Je hebt
                                                nog
                                                geen artikelen in je winkelmand <a href="index.php?page=products">Winkel
                                                    nu!</a></p>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($products as $product): ?>
                                        <tr>
                                            <td class="middle">
                                                <span>
                                                    <?= $product['name'] ?>
                                                </span>
                                                <br>
                                                <span>
                                                        <b>x<?= $products_in_cart[$product['id']] ?></b>
                                                </span>
                                            </td>
                                            <td class="middle">
                                                <span>
                                                     &euro;<?= $product['price'] * $products_in_cart[$product['id']] ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <tr>
                                    <td>
                                        <span class=""><b>Subtotaal:</b></span>
                                    </td>
                                    <td>
                                        <span class="">&euro;<?= $subtotal ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class=""><b>Totaal:</b></span>
                                    </td>
                                    <td>
                                        <span class="">&euro;<?= $subtotal ?></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-secondary ch_button" type="submit">Bestelling plaatsen
                            </button>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= template_footer() ?>
