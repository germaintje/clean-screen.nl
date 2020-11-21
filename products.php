<?php
// The amounts of products to show on each page
$num_products_on_each_page = 100;
// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
//$current_company = isset($_GET['company']) && is_numeric($_GET['company']) ? (int)$_GET['company'] : 1;
// Select products ordered by the date added
$stmt = $pdo->prepare("SELECT * FROM products AS p JOIN company AS c ON p.company_id=c.company_id WHERE available=0 ORDER BY date_added DESC LIMIT ?,?");
$cat = $pdo->prepare("SELECT * FROM company");
// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();

$cat->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$cat->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$cat->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$company = $cat->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of products
$total_products = $pdo->query('SELECT * FROM products')->rowCount();

?>


<?= template_header('Products') ?>
<div class="row">
    <div class="col-12 products_section_middle">
        <div class="container">
            <div class="col-12 text_center">
                <h2>Onze producten</h2>
            </div>
            <?php foreach ($company as $company_name): ?>
                <div class="col-12">
                    <h3><?= $company_name['company_name'] ?></h3>
                </div>

                <?php foreach ($products as $product): ?>
                    <?php if ($company_name['company_id'] == $product['company_id']) { ?>
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
                                        <span class="">&euro;<?= decimal($product['price'], ',', '.') ?></span></a>

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
                                        <button class="minus page-link" <?=$voorraad_btn?>><i class="fas fa-minus"></i>
                                        </button>

                                        <input class="page-link" type="number"
                                               name="quantity"
                                               value="1" min="1"
                                               max="<?= $product['max_products'] ?>"
                                               placeholder="Quantity"
                                               required <?=$voorraad_btn?>>
                                        <button class="plus page-link" <?=$voorraad_btn?>><i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                    <button class="page-link" type="submit" value="In" <?=$voorraad_btn?>><i
                                                class="fas fa-cart-plus"></i></button>
                                </form>

                            </div>
                        </div>
                    <?php } ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= template_footer() ?>

