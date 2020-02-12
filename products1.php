<?php
session_start();
error_reporting(0);


if (!empty($_GET['firstname'])) {
    $_SESSION['firstname'] = $_GET['firstname'];
}

$firstname = $_SESSION['firstname'];

$products = array("Product 1", "Product 2", "Product 3", "Product 4", "Product 5", "Product 6", "Product 7", "Product 8", "Product 9");
$amounts = array("20", "15", "24", "10", "20", "19", "15", "17", "20");

if (!isset($_SESSION["total"])) {
    $_SESSION["total"] = 0;
    for ($i = 0; $i < count($products); $i++) {
        $_SESSION["qty"][$i] = 0;
        $_SESSION["amounts"][$i] = 0;
    }
}

if (isset($_GET['reset'])) {
    if ($_GET["reset"] == 'true') {
        unset($_SESSION["qty"]);
        unset($_SESSION["amounts"]);
        unset($_SESSION["total"]);
        unset($_SESSION["cart"]);
    }
}

if (isset($_GET["add"])) {
    $i = $_GET["add"];
    $qty = $_SESSION["qty"][$i] + 1;
    $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
    $_SESSION["cart"][$i] = $i;
    $_SESSION["qty"][$i] = $qty;
}


if (isset($_GET["delete"])) {
    $i = $_GET["delete"];
    $qty = $_SESSION["qty"][$i];
    $qty--;
    $_SESSION["qty"][$i] = $qty;
    if ($qty == 0) {
        $_SESSION["amounts"][$i] = 0;
        unset($_SESSION["cart"][$i]);
    } else {
        $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
    }
}
if (isset($_GET['logout'])) {
    if ($_GET["logout"] == 'true') {
        session_destroy();
        session_unset();
        header("Location:/webassign5/page1.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Products | Electronics</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body class="product-page">
    <header>
        <h1>Hi <?php echo $_SESSION['firstname'] ?>,</h1>
        <nav>
            <button><a href="products1.php">Electronics</a></button>
            <button><a href="products2.php">Health &amp; Beauty</a></button>
            <button><a href="products3.php">Shoes</a></button>
            <button><a href="?logout=true">Logout</a></button>
        </nav>
    </header>
    <main>
        <h2>Electronics</h2>
        <div class="catalog">
            <?php
            for ($i = 0; $i < 3; $i++) {
                ?>
                <div class="cards">
                    <?php echo '<img src="image/image' . ($i) . '.jpg" width="150" height="150" />' ?>
                    <h3><?php echo ($products[$i]); ?></h3>
                    <p class="price"><?php echo ($amounts[$i]); ?></p>
                    <p><button><a href="?firstname=<?php echo $firstname; ?>&submit=&add=<?php echo ($i); ?>">Add to cart</a></button></p>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="reset">
            <button><a href="?firstname=<?php echo $firstname; ?>&submit=&reset=true">Reset Cart</a></button>
        </div>
        <h2>Cart</h2>
        <div class="cart">
            <?php
            if (isset($_SESSION["cart"])) {
                ?>
                <table>
                    <tr>
                        <th>Product</th>
                        <th width="10px">&nbsp;</th>
                        <th>Quantity</th>
                        <th width="10px">&nbsp;</th>
                        <th>Amount</th>
                        <th width="10px">&nbsp;</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $total = 0;
                        foreach ($_SESSION["cart"] as $i) {
                            ?>
                        <tr>
                            <td><?php echo ($products[$_SESSION["cart"][$i]]); ?></td>
                            <td width="10px">&nbsp;</td>
                            <td><?php echo ($_SESSION["qty"][$i]); ?></td>
                            <td width="10px">&nbsp;</td>
                            <td><?php echo ($_SESSION["amounts"][$i]); ?></td>
                            <td width="10px">&nbsp;</td>
                            <td><a href="?firstname=<?php echo $firstname; ?>&submit=&delete=<?php echo ($i); ?>">Delete from cart</a></td>
                        </tr>
                    <?php
                            $total = $total + $_SESSION["amounts"][$i];
                        }
                        $_SESSION["total"] = $total;
                        ?>
                    <tr>
                        <td colspan="7">Total : <?php echo ($total); ?></td>
                    </tr>
                </table>
            <?php
            }
            ?>
        </div>
    </main>
</body>

</html>