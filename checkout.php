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


/**
 * free shipping price calculate
 */
if ($subtotal > 50) {
    $shipping_price = 0.00;
    $shipping = decimal($shipping_price, ',', '.');
    $shipping = "gratis";
} else {
    $shipping_price = 4.95;
    $shipping = decimal($shipping_price, ',', '.');
}

$total = $subtotal + $shipping_price;


/**
 * formulier handelingen
 */

// define variables and set to empty values
$first_nameErr = $last_nameErr = $countryErr = $zip_codeErr = $street_nameErr = $street_numberErr = $street_addonsErr = $cityErr = $phone_numberErr = $mail_addressErr = "";
$first_name = $last_name = $country = $zip_code = $street_name = $street_number = $street_addons = $city = $phone_number = $mail_address = "";
$first_name_submit = $last_name_submit = $zip_code_submit = $street_name_submit = $street_number_submit = $city_submit = $phone_number_submit = $mail_address_submit = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /**
     * check if first name is valid || CHECK
     */
    if (empty($_POST["first_name"])) {
        $first_nameErr = "Voornaam is verplicht";
    } else {
        $first_name = test_input($_POST["first_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $first_name)) {
            $nameErr = "Alleen letters en spatie's zijn toegestaan";
        } else {
            $first_name_submit = true;
        }
    }

    /**
     * check if last name is valid || CHECK
     */
    if (empty($_POST["last_name"])) {
        $last_nameErr = "Achternaam is verplicht";
    } else {
        $last_name = test_input($_POST["last_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z]* ?[a-zA-Z]*$/", $last_name)) {
            $last_nameErr = "Alleen letterszijn toegestaan";
        } else {
            $last_name_submit = true;
        }
    }

    /**
     * check if country is valid
     */
    if (empty($_POST["country"])) {
        var_dump($_POST["country"]);
        $countryErr = "land is verplicht";
    } else {
        $country = test_input($_POST["country"]);
    }

    /**
     * check if zip code is valid || CHECK
     */
    if (empty($_POST["zip_code"])) {
        $zip_codeErr = "postcode is verplicht";
    } else {
        $zip_code = test_input($_POST["zip_code"]);
        // check if zip code only contains 4 numbers and 2 letters
        if (!preg_match("/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i", $zip_code)) {
            $zip_codeErr = "Eerste 4 cijfers en daarna 2 letters";
        } else {
            $zip_code_submit = true;
        }
    }

    /**
     * check if street name is valid || CHECK
     */
    if (empty($_POST["street_name"])) {
        $street_nameErr = "straatnaam is verplicht";
    } else {
        $street_name = test_input($_POST["street_name"]);
        // check if street name only contains letters
        if (!preg_match("/^[a-zA-Z\s]+$/", $street_name)) {
            $street_nameErr = "Alleen letters zijn toegestaan";
        } else {
            $street_name_submit = true;
        }
    }

    /**
     * check if street number is valid || CHECK
     */
    if (empty($_POST["street_number"])) {
        $street_numberErr = "straatnaam is verplicht";
    } else {
        $street_number = test_input($_POST["street_number"]);
        // check if zip code only contains 4 numbers and 2 letters
        if (!preg_match("/^[0-9a-zA-Z]*$/", $street_number)) {
            $street_numberErr = "Alleen letters en nummers zijn toegestaan";
        } else {
            $street_number_submit = true;
        }
    }

    /**
     * check if street addons is valid
     */
    if (empty($_POST["street_addons"])) {
        $street_addonsErr = "straatnaam is verplicht";
    } else {
        $street_addons = test_input($_POST["street_addons"]);
    }

    /**
     * check if city is valid
     */
    if (empty($_POST["city"])) {
        $cityErr = "stad is verplicht";
    } else {
        $city = test_input($_POST["city"]);
        // check if zip code only contains 4 numbers and 2 letters
        if (!preg_match("/^[a-zA-Z]*$/", $city)) {
            $cityErr = "Alleen letters en nummers zijn toegestaan";
        } else {
            $city_submit = true;
        }
    }

    /**
     *
     * check if phone number is valid
     */
    if (empty($_POST["phone_number"])) {
        $phone_numberErr = "telefoonnummer is verplicht";
    } else {
        $phone_number = test_input($_POST["phone_number"]);
        // check if zip code only contains 4 numbers and 2 letters
        if (!preg_match("/^\(?([+]31|0031|0)-?6(\s?|-)([0-9]\s{0,3}){8}$/", $phone_number)) {
            $phone_numberErr = "Alleen letters en nummers zijn toegestaan";
        } else {
            $phone_number_submit = true;
        }
    }

    /**
     * check if email is valid
     */

    if (empty($_POST["mail_address"])) {
        $mail_addressErr = "Email is required";
    } else {
        $mail_address = test_input($_POST["mail_address"]);
        // check if e-mail address is well-formed
        if (!filter_var($mail_address, FILTER_VALIDATE_EMAIL)) {
            $mail_addressErr = "Invalid email format";
        } else {
            $mail_address_submit = true;
        }
    }

    if ($first_name_submit == true && $last_name_submit == true && $zip_code_submit == true && $street_name_submit == true && $street_number_submit == true && $city_submit == true && $phone_number_submit == true && $mail_address_submit == true) {
        $_SESSION["first_name"] = $first_name;
        $_SESSION["last_name"] = $last_name;
        $_SESSION["street_name"] = $street_name;
        $_SESSION["street_number"] = $street_number;
        $_SESSION["street_addons"] = $street_addons;
        $_SESSION["zip_code"] = $zip_code;
        $_SESSION["city"] = $city;
        $_SESSION["phone_number"] = $phone_number;
        $_SESSION["mail_address"] = $mail_address;
        $_SESSION["shipping_price"] = $shipping_price;
        header("Location: index.php?page=mollie_payment");
    }


}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<?= template_header('Winkelwagen') ?>

<div class="row">
    <div class="col-12 no_padding">
        <div class="container">
            <div class="desktop_cart">
                <form action="<?php echo htmlspecialchars("index.php?page=checkout"); ?>" method="post">
                    <div class="col-12 col-xl-7">
                        <div class="col-12">
                            <h4 class="title_pad">Gegevens</h4>

                            <div class="form-group col-6 no_padding">
                                <label for="first_name">voornaam*</label>
                                <input id="first_name" type="text" class="form-control" name="first_name"
                                       value="<?php echo $first_name; ?>">
                                <span class="error"><?php echo $first_nameErr; ?></span>
                            </div>

                            <div class="form-group col-6 no_padding">
                                <label for="second_name">achternaam*</label>
                                <input id="second_name" type="text" class="form-control" name="last_name"
                                       value="<?php echo $last_name; ?>">
                                <span class="error"><?php echo $last_nameErr; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="country">Land</label>
                                <select id="country" name="country" class="form-control">
                                    <option value="nederland" name="country">Nederland</option>
                                </select>
                                <span class="error"><?php echo $countryErr; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="inputZip">Postcode*</label>
                                <input id="inputZip" type="text" class="form-control" name="zip_code"
                                       value="<?php echo $zip_code; ?>">
                                <span class="error"><?php echo $zip_codeErr; ?></span>
                            </div>

                            <div class="form-group col-9 no_padding">
                                <label for="street">Straat*</label>
                                <input id="street" type="text" class="form-control" name="street_name"
                                       value="<?php echo $street_name; ?>">
                                <span class="error"><?php echo $street_nameErr; ?></span>
                            </div>

                            <div class="form-group col-3 no_padding">
                                <label for="street">huisnummer*</label>
                                <input id="street" type="text" class="form-control" name="street_number"
                                       value="<?php echo $street_number; ?>">
                                <span class="error"><?php echo $street_numberErr; ?></span>
                            </div>

                            <div class="form-group">
                                <input id="street" type="text" class="form-control" name="street_addons"
                                       placeholder="Toevoegingen" value="<?php echo $street_addons; ?>">
                            </div>

                            <div class="form-group">
                                <label for="stad">stad*</label>
                                <input id="stad" type="text" class="form-control" name="city"
                                       value="<?php echo $city; ?>">
                                <span class="error"><?php echo $cityErr; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="phone_number">Telefoon*</label>
                                <input id="phone_number" type="text" class="form-control" name="phone_number"
                                       value="<?php echo $phone_number; ?>">
                                <span class="error"><?php echo $phone_numberErr; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="email_adress">E-mailadres*</label>
                                <input id="email_adress" type="email" class="form-control" name="mail_address"
                                       value="<?php echo $mail_address; ?>">
                                <span class="error"><?php echo $mail_addressErr; ?></span>
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
                                <span class="f_right"><?= $shipping ?></span>
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
