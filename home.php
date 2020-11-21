<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products WHERE available=0 AND homepage=1 ORDER BY order_items');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?= template_header('Home') ?>
<div class="row">
    <div class="col-12 no_padding">
        <div class="background_img no_padding col-sm-12 col-md-6">
            <video autoplay muted loop id="myVideo" class="video_back" width="100%" height="100%">
                <source src="assets/vid/rain_buster_vid.mov" type="video/mp4">
            </video>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="col-12 col-xl-4 no_padding">
                <h4>Clean-screen</h4>
                <p>Benieuwd wat clean-screen.nl nog meer verkoopt? Klik op de knop hieronder</p>
                <a href="index.php?page=products" class="btn btn-primary">Bekijk producten</a>
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
                            <a href="index.php?page=product&id=<?= $product['id'] ?>" class="no_deco">
                                <span class="product_title"><?= $product['name'] ?></span><br></a>

                            <a href="index.php?page=product&id=<?= $product['id'] ?>" class="no_deco">
                                <span class="product_title_price">&euro;<?= decimal($product['price'], ',', '.') ?></span></a>

                            <?php if ($product['quantity_item_left'] == 0) { ?>
                                <?= "<span class=\"red\"><i class=\"fas fa-times\"></i> Niet op voorraad</span>"; ?>
                                <?php $voorraad_btn = "disabled"; ?>
                            <?php } else { ?>
                                <?= "<span class=\"green\"><i class=\"fas fa-check\"></i> Op voorraad</span>"; ?>
                                <?php $voorraad_btn = ""; ?>
                            <?php } ?>
                        </div>

                        <form action="index.php?page=cart" method="post" class="products_add_ov">
                            <div class="number pagination ">
                                <button class="minus page-link" <?= $voorraad_btn ?>><i class="fas fa-minus"></i>
                                </button>

                                <input class="page-link" type="number"
                                       name="quantity"
                                       value="1" min="1"
                                       max="<?= $product['max_products'] ?>"
                                       placeholder="Quantity"
                                       required <?=$voorraad_btn?>>

                                <button class="plus page-link" <?= $voorraad_btn ?>><i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <button class="page-link" type="submit" value="In" <?= $voorraad_btn ?>><i
                                        class="fas fa-cart-plus"></i></button>
                        </form>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= template_footer() ?>
