<?php
// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
// Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
// Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_POST['product_id']]);
// Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
// Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
// Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
// Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
// Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
// There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
// Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}

// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}

// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}

// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: index.php?page=placeorder');
    exit;
}

// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
}

// checkout session variables
$_SESSION["products"] = $products;
$_SESSION["subtotal"] = $subtotal;
$_SESSION["products_in_cart"] = $products_in_cart;

foreach ($products as $product) {
    $_SESSION["item_id"] = $product['id'];
//    $_SESSION["item_quantity"] = $product['quantity'];
}

if (count($products_in_cart) < 1) {
    $shipping = 0.00;
    $checkout_button = "<a class=\"btn btn-primary ch_button disabled\" type=\"submit\">Checkout</a>";
} else {
    $shipping = 4.95;
    $checkout_button = "<a class=\"btn btn-primary ch_button\" type=\"submit\" href=\"index.php?page=checkout\">Checkout</a>";
}


if (count($products_in_cart) > 1) {
    $product_shopping_cart = count($products_in_cart) . " Artikelen";
} else {
    $product_shopping_cart = count($products_in_cart) . " Artikel";
}
//todo:: zet nog ff in de database

$total = $subtotal + $shipping;

?>

<?= template_header('Winkelwagen') ?>

<div class="row">
    <div class="col-12 no_padding margin_top_bottom">
        <div class="container">
            <div class="desktop_cart">
                <form action="index.php?page=cart" method="post">
                    <div class="col-12 col-xl-8">
                        <div class="col-12 cart_lines_border">
                            <h4>winkelmand (<?= $product_shopping_cart ?>)</h4>
                            <?php if (empty($products_in_cart)): ?>
                                <p class="alert alert-danger">Je hebt
                                    nog
                                    geen artikelen in je winkelmand <a href="index.php?page=products">Winkel
                                        nu!</a>
                                </p>
                            <?php else: ?>
                                <?php foreach ($products as $product): ?>
                                    <div class="col-12 border_underline">
                                        <div class="col-4 no_padding">
                                            <a href="index.php?page=product&id=<?= $product['id'] ?>">
                                                <img class="cart_img" src="assets/img/<?= $product['img'] ?>"
                                                     alt="<?= $product['name'] ?>">
                                            </a>
                                        </div>
                                        <div class="col-4 no_padding">
                                            <div class="col-12 no_padding h_5pc">
                                                <a class="text-secondary item_title"
                                                   href="index.php?page=product&id=<?= $product['id'] ?>">
                                                    <?= $product['name'] ?>
                                                </a>
                                            </div>
                                            <br>
                                            <div class="col-12 cart_margin">
                                                <a href="index.php?page=cart&remove=<?= $product['id'] ?>"
                                                   class="delete_line"><i
                                                            class="fas fa-trash-alt red"></i> Verwijder artikel</a>
                                            </div>
                                        </div>
                                        <div class="col-4 no_padding">
                                            <div class="col-12 no_padding h_5pc">
                                                <div class="number pagination f_right">
                                                    <button class="minus btn page-link"><i class="fas fa-minus"></i>
                                                    </button>
                                                    <input class="page-link" type="number"
                                                           name="quantity-<?= $product['id'] ?>"
                                                           value="<?= $products_in_cart[$product['id']] ?>" min="1"
                                                           max="<?= $product['quantity_item_left'] ?>"
                                                           placeholder="Quantity"
                                                           required>
                                                    <button class="plus page-link"><i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-12 cart_margin">
                                                    <span class="f_right bold item_total">
                                            &euro;<?= decimal($product['price'] * $products_in_cart[$product['id']], ',', '.') ?>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <button class="f_right btn btn-secondary" type="submit" name="update"><i
                                        class="fas fa-sync-alt"></i> Winkelmand bijwerken
                            </button>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4 f_right">
                        <div class="col-12 cart_lines_border">
                            <h4 class="title_pad">Te betalen bedrag</h4>
                            <div class="col-12 padding_self_cart">
                                <span class="">Subtotaal</span>
                                <span class="f_right">&euro;<?= decimal($subtotal, ',', '.') ?></span>
                            </div>
                            <div class="col-12 padding_self_cart border_underline">
                                <span class="">Verzendkosten</span>
                                <span class="f_right">&euro;<?= decimal($shipping, ',', '.') ?></span>
                            </div>
                            <div class="col-12 no_padding_l_r">
                                <span class=""><b>Totaal:</b></span>
                                <span class="f_right">&euro;<?= decimal($total, ',', '.') ?></span>
                            </div>
                            <div class="col-12 no_padding">
                                <div class="col-12 no_padding">
                                    <?= $checkout_button ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!--            Mobile cart styles -->

            <div class="mobile_cart">
                <form action="index.php?page=cart" method="post">
                    <div class="col-12">
                        <div class="col-12 cart_lines_border">
                            <h4>winkelmand (<?= $product_shopping_cart ?>)</h4>
                            <?php if (empty($products)): ?>
                                <p class="alert alert-danger">Je hebt nog
                                    geen artikelen in je winkelmand <a href="index.php?page=products">Winkel
                                        nu!</a></p>
                            <?php else: ?>
                                <?php foreach ($products as $product): ?>
                                    <div class="col-12 border_underline">
                                        <div class="col-4 no_padding">
                                            <a href="index.php?page=product&id=<?= $product['id'] ?>">
                                                <img class="cart_img" src="assets/img/<?= $product['img'] ?>"
                                                     alt="<?= $product['name'] ?>">
                                            </a>
                                        </div>
                                        <div class="col-8 no_padding">
                                            <div class="col-12 no_padding">
                                                <a class="text-secondary item_title"
                                                   href="index.php?page=product&id=<?= $product['id'] ?>">
                                                    <?= $product['name'] ?>
                                                </a>
                                            </div>
                                            <br>
                                            <div class="number pagination f_left">
                                                <button class="minus btn page-link"><i class="fas fa-minus"></i>
                                                </button>
                                                <input class="page-link input_number_quantity no_padding" type="number"
                                                       name="quantity-<?= $product['id'] ?>"
                                                       value="<?= $products_in_cart[$product['id']] ?>" min="1"
                                                       max="<?= $product['quantity_item_left'] ?>"
                                                       placeholder="Quantity"
                                                       required>
                                                <button class="plus page-link"><i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 no_padding">
                                            <a href="index.php?page=cart&remove=<?= $product['id'] ?>"
                                               class="delete_line"><i
                                                        class="fas fa-trash-alt red"></i> Verwijder artikel</a>

                                            <span class="f_right bold item_total">
                                            &euro;<?= decimal($product['price'] * $products_in_cart[$product['id']], ',', '.') ?>
                                            </span>
                                        </div>


                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <button class="f_left btn btn-secondary" type="submit" name="update"><i
                                        class="fas fa-sync-alt"></i> Winkelmand bijwerken
                            </button>
                        </div>
                    </div>

                    <div class="col-12 col-xl-4 f_right">
                        <div class="col-12 cart_lines_border">
                            <h4 class="title_pad">Te betalen bedrag</h4>
                            <div class="col-12 padding_self_cart">
                                <span class="">Subtotaal</span>
                                <span class="f_right">&euro;<?= decimal($subtotal, ',', '.') ?></span>
                            </div>
                            <div class="col-12 padding_self_cart border_underline">
                                <span class="">Verzendkosten</span>
                                <span class="f_right">&euro;<?= decimal($shipping, ',', '.') ?></span>
                            </div>
                            <div class="col-12 no_padding_l_r">
                                <span class=""><b>Totaal:</b></span>
                                <span class="f_right">&euro;<?= decimal($total, ',', '.') ?></span>
                            </div>
                            <div class="col-12 no_padding">
                                <div class="col-12 no_padding">
                                    <?= $checkout_button ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--            End mobile styles-->


        </div>
    </div>

</div>

<?= template_footer() ?>
