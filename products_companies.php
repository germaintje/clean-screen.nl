<?php
// The amounts of products to show on each page
$num_company_on_each_page = 8;
// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Select products ordered by the date added
$stmt = $pdo->prepare('SELECT * FROM company LIMIT ?,?');
// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
$stmt->bindValue(1, ($current_page - 1) * $num_company_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_company_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$companies = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of products
$total_companies = $pdo->query('SELECT * FROM company')->rowCount();
?>

<?= template_header('Products_companies') ?>
<div class="row">
    <div class="col-12 products_section_middle">
        <div class="container">
            <div class="col-12 text_center">
<!--                <h2>Categorieën producten</h2>-->
<!--                <h2>producten Categorieën</h2>-->
<!--                <h2>Categorieën</h2>-->
            </div>
            <?php foreach ($companies as $company): ?>

                <div class="col-12 col-md-4 col-xl-4 text_center">
                    <div class="col-12 product_background_sponsor">
                        <div class="product">
                            <a href="index.php?page=products&company=<?= $company['company_id'] ?>" class="">
                                <span class="product_title"><?= $company['company_name'] ?></span><br></a>
                        </div>

                        <div class="product">
                            <a href="index.php?page=products&company=<?= $company['company_id'] ?>" class="">
                                <img class="sponsor_img" src="assets/img/<?= $company['company_logo'] ?>"
                                     alt="<?= $company['company_name'] ?>">
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= template_footer() ?>

