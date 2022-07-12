<?php
session_start();
include "products.php";
$id = $_GET['id'];
$cart = $_SESSION['cart'] ?? array();
$cart[]=$id;
$_SESSION['cart'] = $cart;

header('Location: index.php');

