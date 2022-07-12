<?php
if (isset($_GET['search'])) {
  if (isset($_COOKIE['PreviousSearch'])) {
  
    $previousSearches = unserialize($_COOKIE['PreviousSearch']);
  } else {
    $previousSearches = array();
  }
  
  $previousSearches[] = $_GET['size'];
  if (count($previousSearches) > 3) {
    array_shift($previousSearches);
  }
  setcookie('PreviousSearch', serialize($previousSearches), time()+60,);


}
session_start();

require "products.php";
?>
<html>

<head>
  <title>PHP End of Module Assignment</title>
  
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <h1>PHP End of Module Assignment</h1>
  <br>
  <h3>Add new product</h3>
<?php 
if (isset($_POST['add_product'])) {
  if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
  }
  $product_count = count($_SESSION['products']);
  $_SESSION['products'][$product_count] = [
    'name' => $_POST['name'],
    'image' => $_POST['image'],
    'size' => $_POST['size'],
  ];
}?>
<div class="addProducts">
    <form action="index.php" method="POST">
        <input type="text" name="name" placeholder="product name" />
        <input type="text" name="image" placeholder="product image" />
        <select name="size">
            <option value="xxLarge">xxLarge</option>
            <option value="large">large</option>
            <option value="xSmall">xSmall</option>
            <option value="small">small</option>
            <option value="medium">medium</option>
        </select>
        <input type="submit" value="Add a product" name="add_product" />
    </form>
    </div>
    <h3>Filter by size</h3>
  <div class="search">

    <form action="index.php">
      <input type="text" name="size" placeholder="product size" />
      <input type="submit" name="search" value="search">
    </form>
  </div>
  <h4> Last <span>3</span> Searches : <br></h4>
<?php
if (isset($_GET['search'])) {
foreach($previousSearches as $size ){   
  echo "<span> $size </span> ";   
}}
?>
  <div id="cart">
    <?php $cart = $_SESSION["cart"] ?? array(); ?>
    <h4>You have <span> <?php echo count($cart) ?> items </span> in your cart</h4>
    <br>
    <button onclick="location.href='cart.php'" type="button">
      View You Cart</button>
  </div>
  <br>

  <p>Our Products: </p>
  
  <?php
  if (!isset($_GET['search'])) : ?>
    <div id="products"><?php foreach(
          array_merge($_SESSION['products'] ?? [], $products) as $pid => $p): 
      ?>
                       
        <div class="pCell">
          <div class="pTxt">
            <div class="pName"><?= $p["name"] ?></div>
            <div class="pSize"><?= $p["size"] ?></div>
          </div>
          <img class="pImg" src="<?= $p["image"] ?>" />

          <button onclick="location.href='addToCart.php?id=<?php echo $pid ?>'" type="button">
            Add to Cart</button>
        </div>
        <?php  
          if ($pid==14) {
            break;
          }
        ?>

        
      <?php endforeach; ?>
    </div>

  <?php elseif (isset($_GET['search'])) : ?>
    <div id="products"><?php foreach(
          array_merge($_SESSION['products'] ?? [], $products) as $pid => $p): 
      ?>
    <?php if ($_GET['size'] == $p["size"]) : ?>
      
          <div class="pCell">
            <div class="pTxt">
              <div class="pName"><?= $p["name"] ?></div>
              <div class="pSize"><?= $p["size"] ?></div>
            </div>
            <img class="pImg" src="<?= $p["image"] ?>" />

            <button onclick="location.href='addToCart.php?id=<?php echo $pid ?>'" type="button">
              Add to Cart</button>
          </div>
          <?php endif ?>
        <?php endforeach; ?>
      </div>
    

  <?php endif; ?>


</body>

</html>