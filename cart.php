<?php include('partials-front/menu.php'); ?>

<style>
    /* Styling for Cart Page matching System Theme */
    body {
        background-color: #fdfaf6; /* Cream background */
        color: #2d3748;
        font-family: 'Raleway', sans-serif;
    }

    .cart-section {
        padding-top: 150px;
        padding-bottom: 80px;
        min-height: 100vh;
    }

    .cart-section h2 {
        font-size: 2.2rem;
        font-weight: 700;
        color: #a7004e;
        margin-bottom: 40px;
        text-align: center;
        letter-spacing: -0.5px;
    }

    .cart-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
        width: 100%;
        display: flex;
        flex-direction: row;
        gap: 40px;
        align-items: flex-start;
        flex-wrap: wrap;
    }

    /* Left Column: Cart items table card */
    .cart-table-card {
        flex: 2;
        min-width: 320px;
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(167, 0, 78, 0.02);
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .cart-table th {
        font-family: 'Raleway', sans-serif;
        color: #718096;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding-bottom: 20px;
        border-bottom: 1px solid #edf2f7;
    }

    .cart-table td {
        padding: 20px 0;
        border-bottom: 1px solid #f7fafc;
        vertical-align: middle;
    }

    .cart-item-img {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .cart-item-title {
        font-weight: 700;
        color: #2d3748;
        font-size: 1.05rem;
        margin-bottom: 4px;
    }

    .cart-item-desc {
        color: #718096;
        font-size: 0.85rem;
    }

    .cart-item-price {
        font-weight: 600;
        color: #2d3748;
    }

    /* Quantity controllers */
    .qty-control {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .qty-btn {
        background-color: #f7fafc;
        border: 1px solid #cbd5e0;
        color: #4a5568;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .qty-btn:hover {
        background-color: #a7004e;
        border-color: #a7004e;
        color: #ffffff;
    }

    .qty-val {
        font-weight: 600;
        font-size: 1rem;
        min-width: 20px;
        text-align: center;
    }

    .cart-item-subtotal {
        font-weight: 700;
        color: #a7004e;
    }

    .remove-btn {
        color: #e53e3e;
        font-size: 1.1rem;
        cursor: pointer;
        transition: color 0.2s ease;
        text-decoration: none;
    }

    .remove-btn:hover {
        color: #c53030;
    }

    /* Right Column: Order Summary Card */
    .summary-card {
        flex: 1;
        min-width: 300px;
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 35px 30px;
        box-shadow: 0 10px 30px rgba(167, 0, 78, 0.02);
    }

    .summary-card h3 {
        font-family: 'Raleway', sans-serif;
        color: #2d3748;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 25px;
        border-bottom: 1px solid #edf2f7;
        padding-bottom: 10px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 0.95rem;
        color: #4a5568;
    }

    .summary-row.total {
        border-top: 1px solid #edf2f7;
        padding-top: 20px;
        margin-top: 10px;
        font-size: 1.2rem;
        font-weight: 700;
        color: #a7004e;
    }

    /* Buttons */
    .btn-checkout {
        background-color: #a7004e;
        color: #ffffff !important;
        border: none;
        padding: 15px;
        font-size: 1rem;
        font-weight: 700;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 14px rgba(167, 0, 78, 0.2);
        margin-top: 20px;
        display: block;
        text-align: center;
        text-decoration: none;
    }

    .btn-checkout:hover {
        background-color: #85003e;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(167, 0, 78, 0.35);
    }

    .btn-clear {
        background-color: transparent;
        color: #718096 !important;
        border: 1px dashed #cbd5e0;
        padding: 12px;
        font-size: 0.9rem;
        font-weight: 600;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 15px;
        display: block;
        text-align: center;
        text-decoration: none;
    }

    .btn-clear:hover {
        background-color: #fff5f5;
        color: #e53e3e !important;
        border-color: #feb2b2;
    }

    .btn-continue {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #a7004e;
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 600;
        transition: color 0.2s ease;
    }

    .btn-continue:hover {
        color: #85003e;
    }

    /* Empty state styling */
    .empty-cart {
        text-align: center;
        padding: 60px 40px;
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(167, 0, 78, 0.02);
        max-width: 600px;
        margin: 0 auto;
    }

    .empty-cart i {
        font-size: 4rem;
        color: #feb2b2;
        margin-bottom: 20px;
    }

    .empty-cart p {
        font-size: 1.15rem;
        color: #4a5568;
        margin-bottom: 30px;
    }

    .empty-cart .btn-shop {
        display: inline-block;
        background-color: #a7004e;
        color: #ffffff !important;
        padding: 14px 30px;
        font-size: 1rem;
        font-weight: 700;
        border-radius: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(167, 0, 78, 0.2);
    }

    .empty-cart .btn-shop:hover {
        background-color: #85003e;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(167, 0, 78, 0.35);
    }

    @media (max-width: 768px) {
        .cart-container {
            flex-direction: column;
            gap: 20px;
        }
        .cart-table-card, .summary-card {
            width: 100%;
        }
        .cart-section {
            padding-top: 120px;
        }
    }
</style>

<div class="cart-section">
    <div class="cart-container">
        <?php
        if(isset($_SESSION['cart_message'])) {
            echo '<div style="width:100%; margin-bottom:20px;">' . $_SESSION['cart_message'] . '</div>';
            unset($_SESSION['cart_message']);
        }

        $cart_empty = true;
        $cart_items = [];
        $grand_total = 0;

        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $cart_empty = false;
            // Load items from database
            foreach($_SESSION['cart'] as $item_id => $qty) {
                $sql = "SELECT * FROM tbl_cakes WHERE id=$item_id";
                $res = mysqli_query($conn, $sql);
                if($res && mysqli_num_rows($res) == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $row['qty'] = $qty;
                    $row['subtotal'] = $row['price'] * $qty;
                    $grand_total += $row['subtotal'];
                    $cart_items[] = $row;
                }
            }
        }

        if($cart_empty):
        ?>
            <div class="empty-cart">
                <i class="fa-solid fa-cart-shopping"></i>
                <p>Your shopping cart is currently empty.</p>
                <a href="<?php echo SITEURL; ?>catagory.php" class="btn-shop">Explore Cakes</a>
            </div>
        <?php else: ?>
            <div class="cart-table-card">
                <h2>Your Shopping Cart</h2>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th width="15%">Image</th>
                            <th width="35%">Product</th>
                            <th width="15%">Price</th>
                            <th width="20%">Quantity</th>
                            <th width="15%">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($cart_items as $item): ?>
                            <tr>
                                <td>
                                    <img src="<?php echo SITEURL; ?>images/<?php echo $item['image_name']; ?>" class="cart-item-img">
                                </td>
                                <td>
                                    <div class="cart-item-title"><?php echo $item['title']; ?></div>
                                    <div class="cart-item-desc"><?php echo substr($item['description'], 0, 50) . '...'; ?></div>
                                </td>
                                <td>
                                    <span class="cart-item-price">RS. <?php echo number_format($item['price'], 2); ?></span>
                                </td>
                                <td>
                                    <div class="qty-control">
                                        <a href="<?php echo SITEURL; ?>add_to_cart.php?id=<?php echo $item['id']; ?>&action=decrease" class="qty-btn">-</a>
                                        <span class="qty-val"><?php echo $item['qty']; ?></span>
                                        <a href="<?php echo SITEURL; ?>add_to_cart.php?id=<?php echo $item['id']; ?>&action=add" class="qty-btn">+</a>
                                    </div>
                                </td>
                                <td>
                                    <span class="cart-item-subtotal">RS. <?php echo number_format($item['subtotal'], 2); ?></span>
                                </td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>add_to_cart.php?id=<?php echo $item['id']; ?>&action=remove" class="remove-btn" title="Remove Item">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="summary-card">
                <h3>Order Summary</h3>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>RS. <?php echo number_format($grand_total, 2); ?></span>
                </div>
                <div class="summary-row">
                    <span>Delivery</span>
                    <span style="color:#38a169; font-weight:600;">FREE</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>RS. <?php echo number_format($grand_total, 2); ?></span>
                </div>

                <a href="<?php echo SITEURL; ?>checkout.php" class="btn-checkout">Proceed to Checkout</a>
                <a href="<?php echo SITEURL; ?>add_to_cart.php?action=clear" class="btn-clear">Clear Entire Cart</a>
                <a href="<?php echo SITEURL; ?>catagory.php" class="btn-continue">Continue Shopping</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include('partials-front/footer.php'); ?>
