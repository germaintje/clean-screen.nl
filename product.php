<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
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
?>

<?= template_header('Product') ?>
<div class="row">
    <div class="container">
        <div class="col-12 product_margin product_page">
            <div class="col-12 col-xl-4 text_center">
                <a href="assets/img/<?= $product['img'] ?>" data-lity><img class="detail_product_img"
                                                                           src="assets/img/<?= $product['img'] ?>"
                                                                           width="500" height="500"
                                                                           alt="<?= $product['name'] ?>"></a>
                <span class="price bold">&euro; <?= decimal($product['price'], ',', '.') ?></span><br>
                <?php if ($product['quantity_item_left'] == 0) { ?>
                    <input class="btn btn-primary" type="submit" value="Binnenkort beschikbaar" disabled>
                <?php } else { ?>
                    <form action="index.php?page=cart" method="post">
<!--                        <select name="quantity" class="form-control">-->
<!--                            <option value="prijs" name="quantity">2 stuks</option>-->
<!--                            <option value="prijs" name="quantity">2 stuks</option>-->
<!--                            <option value="prijs" name="quantity">2 stuks</option>-->
<!--                            <option value="prijs" name="quantity">2 stuks</option>-->
<!--                            <option value="prijs" name="quantity">2 stuks</option>-->
<!--                        </select>-->
                        <div class="number pagination f_right">
                            <button class="minus page-link"><i class="fas fa-minus"></i>
                            </button>
                            <input class="page-link" type="number"
                                   name="quantity"
                                   value="<?= $products_in_cart[$product['id']] ?>" min="1"
                                   max="<?= $product['quantity_item_left'] ?>"
                                   placeholder="Quantity"
                                   required>
                            <button class="plus page-link"><i class="fas fa-plus"></i>
                            </button>
                        </div>

<!--                        <input type="number" name="quantity" value="1" min="1" max="--><?//= $product['quantity'] ?><!--"-->
<!--                               placeholder="Quantity" required>-->
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input class="btn btn-primary" type="submit" value="In winkelmand">
                    </form>
                <?php } ?>
            </div>
            <div class="col-12 col-xl-8">
                <h1 class="name"><?= $product['name'] ?></h1>

                <div class="description">
                    <?= $product['desc'] ?>
                </div>

            </div>
        </div>
    </div>
</div>

<?= template_footer() ?>
