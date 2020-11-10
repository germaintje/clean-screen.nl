<?php
function pdo_connect_mysql()
{
    if ($_SERVER['HTTP_HOST'] == "clean-screen.germaindejong.nl") {
        // Update the details below with your MySQL details
        $DATABASE_HOST = 'localhost:3306';
        $DATABASE_USER = 'germain';
        $DATABASE_PASS = '1G?9os7c';
        $DATABASE_NAME = 'rainbuster';
        try {
            return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
        } catch (PDOException $exception) {
            // If there is an error with the connection, stop the script and display the error.
            die ('Er is iets verkeerd gegaan contacteer de systeembeheerder');
        }
    } elseif ($_SERVER['HTTP_HOST'] == "www.clean-screen.germaindejong.nl") {
        // Update the details below with your MySQL details
        $DATABASE_HOST = 'localhost:3306';
        $DATABASE_USER = 'germain';
        $DATABASE_PASS = '1G?9os7c';
        $DATABASE_NAME = 'rainbuster';
        try {
            return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
        } catch (PDOException $exception) {
            // If there is an error with the connection, stop the script and display the error.
            die ('Er is iets verkeerd gegaan contacteer de systeembeheerder');
        }
    } else {
        // Update the details below with your MySQL details
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'clean-screen';
        try {
            return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
        } catch (PDOException $exception) {
            // If there is an error with the connection, stop the script and display the error.
            die ('Er is iets verkeerd gegaan contacteer de systeembeheerder');
        }
    }
}


// Template header, feel free to customize this
function template_header($title)
{
    // Get the amount of items in the shopping cart, this will be displayed in the header.
    $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

    if ($num_items_in_cart > 1) {
        $header_cart_text = "Artikelen";
    } else {
        $header_cart_text = "Artikel";
    }

    echo <<<EOT
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="node_modules/@fortawesome/fontawesome-free/js/all.js"></script>
    <link href="node_modules/lity/dist/lity.css" rel="stylesheet">
    <title>$title</title>
</head>
<body>

<header class="background_container">        
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand rainbuster_logo" href="index.php"><img src="assets/img/clean_screen_logo.png" alt=""> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" href="index.php">Home</a>
                <a class="nav-link" href="index.php?page=products_companies">Winkel</a>
            </div>

            <div class="cart_width" style="width: 100%">
                <a class="nav-link shopping_cart" href="index.php?page=cart"><i class="fas fa-shopping-cart"> </i> <span>$num_items_in_cart</span> $header_cart_text</a>
            </div>

        </div>
    </div>
</nav>
</header>
<main>

EOT;
}

// Template footer
function template_footer()
{
    $year = date('Y');
    echo <<<EOT
        </main>
        <!--   FOOTER START================== -->
    
    <footer class="footer">
    <div class="container">
        <div class="row">

            <div class="col-sm-4">
                <h4 class="title">Clean-screen.nl</h4>
                <p>[Kort wat info over het bedrijf.]</p>
                </div>
            <div class="col-sm-4">
                <h4 class="title">Pagina's</h4>
                <span class="acount-icon">          
                <a class="fit" href="index.php?page=home"><i class="fas fa-home" aria-hidden="true"></i> Home</a>
                <a class="fit" href="index.php?page=products_companies"><i class="fas fa-store" aria-hidden="true"></i> Winkel</a>
                <a class="fit" href="https://instagram.com/cleanscreen.nl?igshid=1rdinvprr2935"><i class="fab fa-instagram" aria-hidden="true"></i> @clean-screen.nl</a>           
              </span>
                </div>
            <div class="col-sm-4">
                <h4 class="title">Gegevens clean-screen.nl</h4>
                <span>KVK: 80538894</span><br>
                <span>Btw: NL003453793871</span><br>
                <span>IBAN: NL89 RABO 0360 1976 71</span><br>
                <span>Tel: 06 42484650</span><br>
                
                <ul class="payment">
                <li><a href="https://www.mollie.com/en/payments/ideal"><i class="fab fa-ideal" aria-hidden="true"></i></a></li>         
                <li><a href="https://www.mollie.com/en/payments/credit-card"><i class="fab fa-cc-mastercard" aria-hidden="true"></i></a></li>
                <li><a href="https://www.mollie.com/en/payments/apple-pay"><i class="fab fa-cc-apple-pay" aria-hidden="true"></i></a></li>
                <li><a href="https://www.mollie.com/en/payments/paypal"><i class="fab fa-cc-paypal" aria-hidden="true"></i></a></li>
                </ul>
                </div>
            </div>
            <hr>
            
            <div class="text-center"><p>@ 2020 Cleanscreen</p></div>

        </div>
        
        
    </footer>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="node_modules/jquery/dist/jquery.js"></script>
        <script src="node_modules/lity/dist/lity.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
        <script src="assets/js/quality-button.js"></script>
    </body>
</html>
EOT;
}

function decimal($number, $decimal_sep, $thousand_sep)
{
    return number_format($number, 2, $decimal_sep, $thousand_sep);
}

?>
