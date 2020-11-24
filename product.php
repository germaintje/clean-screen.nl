<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $img = $pdo->prepare('SELECT * FROM product_img WHERE id = ?');

    $stmt->execute([$_GET['id']]);
    $img->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    $images = $img->fetchAll(PDO::FETCH_ASSOC);

    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        header("Location: " . "index.php", true, 303);
        die ('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    header("Location: " . "index.php", true, 303);
    die ('Product does not exist!');
}


if (isset($_SESSION['products_in_cart'])) {
    $products_in_cart = $_SESSION['products_in_cart'];
} else {
    $products_in_cart = [];
}

?>

<?= template_header('Product') ?>
<div class="row">
    <div class="container">
        <div class="col-12 product_margin product_page">
            <div class="col-12 col-xl-4 text_center">

                <div id="carouselIndicators" class="carousel slide col-12" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php $count = 0; ?>
                        <?php foreach ($images as $image) :
                            $count++;
                            ?>

                            <div class="carousel-item <?php if ($count == 1){echo 'active';} ?>" data-interval="10000">
                                <a href="assets/img/<?= $image['img'] ?>" data-lity>
                                    <img class="detail_product_img" src="assets/img/<?= $image['img'] ?>"
                                         width="500"
                                         height="500" alt="<?= $product['name'] ?>">
                                </a>
                            </div>

                        <?php endforeach; ?>

                    </div>
                    <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <?php if ($product['quantity_item_left'] <= 0) { ?>
                    <input class="btn btn-primary" type="submit" value="Binnenkort beschikbaar" disabled>
                <?php } else { ?>
                    <form action="index.php?page=cart" method="post">
                        <select name="quantity" class="form-control">
                            <?php for ($product_count = 1; $product_count <= $product['max_products']; $product_count++) :
                                $max = $product['quantity_item_left'];
                                foreach ($products_in_cart as $product_id => $product_quantity) {
                                    if ($product['id'] == $product_id) {
                                        $max = $product['quantity_item_left'] - $product_quantity;
                                    }
                                }

                                if ($product_count == 1) {
                                    $piece_text = "stuk";
                                } else {
                                    $piece_text = "stuks";
                                }

                                if ($product_count > $product['discount_first_step']) {
                                    if ($product_count % $product['discount_steps'] == 0 && $product_count <= $product['max_products']) {
                                        $count = $product_count / $product['discount_steps'];
                                    }
                                    $korting = ($product['discount_price'] * $product_count) * $count;
                                } elseif ($product_count <= $product['discount_first_step']) {
                                    $korting = 0.00;
                                }

                                $prijs = decimal(($product['price'] * $product_count) - $korting, ',', '.');

                                if ($product_count <= $max):
                                    ?>
                                    <option value="<?= $product_count ?>"
                                            name="quantity"><?= $product_count ?> <?= $piece_text; ?> --
                                        € <?= $prijs ?></option>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <?php
                            if ($product_count > $max) { ?>
                                <option name="quantity" disabled>Geen voorraad verder
                                </option>
                            <?php }
                            if ($product_count > $product['max_products']) : ?>
                                <option value="index.php?page=contact"
                                        name="quantity2" disabled>
                                    <?= $product_count ?> of meer <?= $piece_text ?>? Neem contact op!
                                </option>
                            <?php endif; ?>
                        </select>
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input class="btn btn-primary add_cart_btn" type="submit" value="In winkelmand">
                    </form>
                <?php } ?>
            </div>
            <div class="col-12 col-xl-8">
                <h1 class="name"><?= $product['name'] ?></h1>
                <div class="description">
                    <?= $product['desc'] ?>
                </div>
                <div>
                    <span class="price bold">Per stuk</span><span> &euro;
                    <?= decimal($product['price'], ',', '.') ?></span><br>
                    <span class="price bold"> Beschikbaar: </span><span><?= $product['quantity_item_left'] ?></span><br>
                </div>
            </div>
        </div>
    </div>
</div>

<?= template_footer() ?>
