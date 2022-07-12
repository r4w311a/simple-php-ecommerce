<?php
session_start();
include "products.php";
$cart = $_SESSION['cart'] ?? array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>

<h1>My Cart : </h1>
    <?php foreach ($_SESSION['cart'] as $key => $value) {
        $savedID[] = $value;
    }

    ?>
    <div id="products">
        <?php foreach ($products as $pid => $p) : ?>
            <?php foreach ($_SESSION['cart'] as $key => $value) : ?>
                <?php if ($pid == $savedID[$key]) : ?>

                    <div class="pCell">
                        <div class="pTxt">
                            <div class="pName"><?= $p["name"] ?></div>
                            <div class="pSize"><?= $p["size"] ?></div>
                        </div>
                        <img class="pImg" src="<?= $p["image"] ?>" />



                    <?php endif; ?>
                <?php endforeach; ?>

            <?php endforeach; ?>
                    </div>

</body>

</html>