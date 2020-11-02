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


/**
 * formulier handelingen
 */

// define variables and set to empty values
$first_nameErr = $last_nameErr = $emailErr = $genderErr = $websiteErr = "";
$first_name = $last_name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /**
     * check if first name is valid
     */
    if (empty($_POST["first_name"])) {
        $first_nameErr = "Voornaam is verplicht";
    } else {
        $first_name = test_input($_POST["first_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $first_name)) {
            $nameErr = "Alleen letters en spatie's zijn toegestaan";
        }
    }

    /**
     * check if last name is valid
     */
    if (empty($_POST["last_name"])) {
        $last_nameErr = "Achternaam is verplicht";
    } else {
        $last_name = test_input($_POST["last_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-']*$/", $last_name)) {
            $last_nameErr = "Alleen letterszijn toegestaan";
        }
    }

    /**
     * check if country is valid
     */

    /**
     * check if province is valid
     */

    /**
     * check if city is valid
     */

    /**
     * check if zip code is valid
     */

    /**
     * check if street name is valid
     */

    /**
     * check if street number is valid
     */

    /**
     * check if street addons is valid
     */

    /**
     * check if phone number is valid
     */

    /**
     * check if email is valid
     */

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }


}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * velden:
 * naam
 * achternaam
 *land
 * provincie
 *
 */


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
                                <input id="first_name" type="text" class="form-control" name="first_name"
                                       value="<?php echo $name; ?>">
                                <span class="error">* <?php echo $nameErr; ?></span>
                            </div>
                            <div class="form-group col-6 no_padding">
                                <label for="second_name">achternaam*</label>
                                <input id="second_name" type="text" class="form-control" name="last_name"
                                       value="<?php echo $name; ?>">
                                <span class="error">* <?php echo $nameErr; ?></span>
                            </div>
                            <!--                            <div class="form-group">-->
                            <!--                                <label for="company_name">Bedrijfsnaam</label>-->
                            <!--                                <input id="company_name" type="text" class="form-control" name="company_name">-->
                            <!--                            </div>-->

                            <div class="form-group">
                                <label for="country">Choose a car:</label>
                                <select name="cars" id="cars" form="carform">
                                    <option value="volvo">Volvo</option>
                                    <option value="saab">Saab</option>
                                    <option value="opel">Opel</option>
                                    <option value="audi">Audi</option>
                                </select>
                                <span class="error">* <?php echo $nameErr; ?></span>
<!--                                <label for="country">land*</label>-->
<!--                                <input id="country" type="text" class="form-control" name="country"-->
<!--                                       value="--><?php //echo $name; ?><!--">-->
<!--                                <span class="error">* --><?php //echo $nameErr; ?><!--</span>-->
                            </div>
                            <div class="form-group">
                                <label for="province">provincie*</label>
                                <input id="province" type="text" class="form-control" name="province"
                                       value="<?php echo $name; ?>">
                                <span class="error">* <?php echo $nameErr; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="city">stad*</label>
                                <input id="city" type="text" class="form-control" name="city"
                                       value="<?php echo $name; ?>">
                                <span class="error">* <?php echo $nameErr; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="inputZip">Postcode*</label>
                                <input id="inputZip" type="text" class="form-control" name="zip_code"
                                       value="<?php echo $name; ?>">
                                <span class="error">* <?php echo $nameErr; ?></span>
                            </div>
                            <div class="form-group col-9 no_padding">
                                <label for="street">Straat*</label>
                                <input id="street" type="text" class="form-control" name="street_name"
                                       value="<?php echo $name; ?>">
                                <span class="error">* <?php echo $nameErr; ?></span>
                            </div>
                            <div class="form-group col-3 no_padding">
                                <label for="street">huisnummer*</label>
                                <input id="street" type="text" class="form-control" name="street_number"
                                       value="<?php echo $name; ?>">
                                <span class="error">* <?php echo $nameErr; ?></span>
                            </div>
                            <div class="form-group">
                                <input id="street" type="text" class="form-control" name="street_addons"
                                       placeholder="Toevoegingen" value="<?php echo $name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Telefoon*</label>
                                <input id="phone_number" type="text" class="form-control" name="phone_number"
                                       value="<?php echo $name; ?>">
                                <span class="error">* <?php echo $nameErr; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="email_adress">E-mailadres*</label>
                                <input id="email_adress" type="email" class="form-control" name="mail_address"
                                       value="<?php echo $name; ?>">
                                <span class="error">* <?php echo $nameErr; ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-5 f_right">
                        <div class="col-12 cart_lines_border">
                            <h4 class="title_pad">Te betalen bedrag</h4>

                            <?php foreach ($products as $product): ?>
                                <div class="col-12 padding_self_cart">
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
                            <div class="col-12 no_padding_l_r border_topline_checkout">
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
