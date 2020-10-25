<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?= template_header('Home') ?>
<div class="row">
    <div class="col-12 no_padding back">
        <div class="background_img">
            <div class="header_text_container text_center">
                <div class="header_text_middle">
                    <h1>RAINBUSTER</h1>
                    <h5>Proeftekst wat wil je hier!</h5>
                    <a href="index.php?page=products" class="btn btn-primary">WEBSHOP</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 products_section_middle">
        <div class="container">
            <div class="col-12 text_center">
                <h2>Artikelen</h2>
            </div>
            <?php foreach ($recently_added_products as $product): ?>
                <div class="col-12 col-md-4 col-xl-4 text_center">
                    <div class="col-12 product_background">
                        <div class="product">
                            <a href="index.php?page=product&id=<?= $product['id'] ?>" class="">
                                <img class="product_img" src="assets/img/<?= $product['img'] ?>"
                                     alt="<?= $product['name'] ?>">
                            </a>
                        </div>

                        <div class="product">
                            <a href="index.php?page=product&id=<?= $product['id'] ?>" class="">
                                <span class="product_title"><?= $product['name'] ?></span><br></a>

                            <a href="index.php?page=product&id=<?= $product['id'] ?>" class="">
                                <span class="">&euro;<?= decimal($product['price'], ',', '.') ?></span></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= template_footer() ?>
