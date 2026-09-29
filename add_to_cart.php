<?php
include('config/constants.php');

// Initialize cart if not already set
if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $action = isset($_GET['action']) ? $_GET['action'] : 'add';

    switch($action) {
        case 'add':
            // Add or increment quantity
            if(isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]++;
            } else {
                $_SESSION['cart'][$id] = 1;
            }
            $_SESSION['cart_message'] = "<div class='success text-center'>Product added to cart!</div>";
            break;

        case 'decrease':
            // Decrement quantity
            if(isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]--;
                if($_SESSION['cart'][$id] <= 0) {
                    unset($_SESSION['cart'][$id]);
                }
            }
            break;

        case 'remove':
            // Remove item from cart completely
            if(isset($_SESSION['cart'][$id])) {
                unset($_SESSION['cart'][$id]);
            }
            $_SESSION['cart_message'] = "<div class='success text-center'>Product removed from cart.</div>";
            break;
    }
}

if(isset($_GET['action']) && $_GET['action'] == 'clear') {
    $_SESSION['cart'] = [];
    $_SESSION['cart_message'] = "<div class='success text-center'>Cart cleared.</div>";
}

// Redirect back to cart page
header('location:'.SITEURL.'cart.php');
exit();
?>
