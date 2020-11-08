<?php
// The amounts of products to show on each page
$num_products_on_each_page = 8;
// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
$current_company = isset($_GET['company']) && is_numeric($_GET['company']) ? (int)$_GET['company'] : 1;
// Select products ordered by the date added
$stmt = $pdo->prepare("SELECT * FROM products WHERE company_id=$current_company AND available=0 ORDER BY date_added DESC LIMIT ?,?");
// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of products
$total_products = $pdo->query('SELECT * FROM products')->rowCount();

//var_dump($products);
?>


<?= template_header('Products') ?>
<div class="row">
    <div class="col-12 products_section_middle">
        <div class="container">
            <div class="col-12 text_center">
                <h2>Artikelen</h2>
            </div>
            <?php foreach ($products as $product): ?>
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

