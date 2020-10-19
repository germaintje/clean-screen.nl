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
        die ('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    die ('Product does not exist!');
}
?>

<?= template_header('Product') ?>
<div class="row">
    <div class="container">
        <div class="col-12 product_margin product_page">
            <div class="col-12 col-xl-4">
                <a href="assets/img/<?= $product['img'] ?>" data-lity><img class="detail_product_img" src="assets/img/<?= $product['img'] ?>" width="500" height="500"
                     alt="<?= $product['name'] ?>"></a>
            </div>
            <div class="col-12 col-xl-8">
                <h1 class="name"><?= $product['name'] ?></h1>

                <span class="price">&euro; <?= $product['price'] ?>
                    <?php if ($product['rrp'] > 0): ?>
                        <span class="rrp">&euro; <?= $product['rrp'] ?></span>
                    <?php endif; ?>
                </span>

                <div class="description">
                    <?= $product['desc'] ?>
                </div>

                <form action="index.php?page=cart" method="post">
                    <input type="number" name="quantity" value="1" min="1" max="<?= $product['quantity'] ?>"
                           placeholder="Quantity" required>
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input class="btn btn-primary" type="submit" value="In winkelmand">
                </form>
            </div>
        </div>
    </div>
</div>

<?= template_footer() ?>
