<?php
/**
 * check if the user didnt put in the url
 */
$products_in_cart = $_SESSION['products_in_cart'];
if (count($products_in_cart) < 1) {
    header("Location:index.php ", true, 303);
}

$products = $_SESSION['products'];
$subtotal = $_SESSION['subtotal'];

$shipping = 4.95;

$total = $subtotal + $shipping;

?>

<?= template_header('Winkelwagen') ?>

<div class="row">
    <div class="col-12 no_padding">
        <div class="container">
            <div class="desktop_cart">
                <form action="index.php?page=mollie_payment" method="post">
                    <div class="col-12 col-xl-7">
                        <div class="col-12">
                            <h4 class="title_pad">Gegevens</h4>
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

                            <div class="form-group">
                                <label for="country">land*</label>
                                <input id="country" type="text" class="form-control" name="company_name">
                            </div>
                            <div class="form-group">
                                <label for="province">provincie*</label>
                                <input id="province" type="text" class="form-control" name="city" required>
                            </div>
                            <div class="form-group">
                                <label for="city">stad*</label>
                                <input id="city" type="text" class="form-control" name="city" required>
                            </div>
                            <div class="form-group">
                                <label for="inputZip">Postcode*</label>
                                <input id="inputZip" type="text" class="form-control" name="zip_code" required>
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
                                <input id="street" type="text" class="form-control" placeholder="Toevoegingen"
                                       name="street_addons">
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
                    </div>

                    <div class="col-12 col-xl-5 f_right">
                        <div class="col-12 cart_lines_border">
                            <h4 class="title_pad">Te betalen bedrag</h4>

                            <?php foreach ($products as $product): ?>
                                <div class="col-12 padding_self_cart border_underline_checkout">
                                    <div class="col-8 no_padding">
                                        <?= $product['name'] ?> <b
                                                class="multi_checkout_tekst">x<?= $products_in_cart[$product['id']] ?></b>
                                    </div>
                                    <div class="col-4 no_padding">
                                        <span class="f_right">
                                        &euro;<?= decimal($product['price'] * $products_in_cart[$product['id']], ',', '.') ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="col-12 no_padding_l_r">
                                <span class=""><b>Subtotaal</b></span>
                                <span class="f_right">&euro;<?= decimal($subtotal, ',', '.') ?></span>
                            </div>
                            <div class="col-12 no_padding">
                                <span class=""><b>Verzendkosten</b></span>
                                <span class="f_right">&euro;<?= decimal($shipping, ',', '.') ?></span>
                            </div>
                            <div class="col-12 no_padding_l_r">
                                <span class=""><b>Totaal:</b></span>
                                <span class="f_right">&euro;<?= decimal($total, ',', '.') ?></span>
                            </div>
                            <div class="col-12 no_padding">
                                <div class="col-12 no_padding">
                                    <button class="btn btn-secondary ch_button" type="submit">Bestelling plaatsen
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

<?= template_footer() ?>
