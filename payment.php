<?php include('partials-front/menu.php'); ?>

<?php
// Validate order_id
if(!isset($_GET['order_id'])) {
    header('location:'.SITEURL);
    exit();
}

$order_id = (int)$_GET['order_id'];
$sql = "SELECT * FROM tbl_order WHERE id=$order_id";
$res = mysqli_query($conn, $sql);

if($res && mysqli_num_rows($res) == 1) {
    $order = mysqli_fetch_assoc($res);
} else {
    header('location:'.SITEURL);
    exit();
}

$payment_success = false;
$payment_method = "";

// Handle payment submission
if(isset($_POST['submit_payment'])) {
    $payment_method = $_POST['payment_method'];
    
    // Determine status based on payment type
    $new_status = ($payment_method == 'card') ? 'Paid' : 'Ordered';
    
    // Update order status in database
    $sql_update = "UPDATE tbl_order SET status='$new_status' WHERE id=$order_id";
    if(mysqli_query($conn, $sql_update)) {
        $payment_success = true;
        // Clear the shopping cart since order is fully paid/placed
        unset($_SESSION['cart']);
    }
}
?>

<style>
    body {
        background-color: #fdfaf6;
        color: #2d3748;
        font-family: 'Raleway', sans-serif;
    }

    .payment-section {
        padding-top: 150px;
        padding-bottom: 80px;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .payment-container {
        max-width: 1000px;
        width: 90%;
        margin: 0 auto;
        display: flex;
        flex-direction: row;
        gap: 40px;
        align-items: flex-start;
        flex-wrap: wrap;
    }

    /* Left Card: Summary */
    .summary-panel {
        flex: 1;
        min-width: 320px;
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 35px 30px;
        box-shadow: 0 10px 30px rgba(167, 0, 78, 0.02);
    }

    .summary-panel h3 {
        font-family: 'Raleway', sans-serif;
        color: #2d3748;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 25px;
        border-bottom: 1px solid #edf2f7;
        padding-bottom: 10px;
    }

    /* Right Card: Methods */
    .method-panel {
        flex: 1.2;
        min-width: 320px;
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 35px 30px;
        box-shadow: 0 10px 30px rgba(167, 0, 78, 0.02);
    }

    .method-panel h3 {
        font-family: 'Raleway', sans-serif;
        color: #2d3748;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 25px;
        border-bottom: 1px solid #edf2f7;
        padding-bottom: 10px;
    }

    .order-item-list {
        margin-bottom: 25px;
    }

    .order-item-detail {
        background: #fdfaf6;
        border: 1px solid #edf2f7;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 15px;
    }

    .order-item-title {
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 5px;
        font-size: 0.95rem;
        line-height: 1.4;
    }

    .price-summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 0.9rem;
        color: #718096;
    }

    .price-summary-row.total {
        border-top: 1px dashed #e2e8f0;
        padding-top: 15px;
        margin-top: 15px;
        font-size: 1.15rem;
        font-weight: 700;
        color: #a7004e;
    }

    /* Payment Methods selector styling */
    .payment-options-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }

    .opt-card {
        border: 2px solid #e2e8f0;
        border-radius: 14px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
    }

    .opt-card input[type="radio"] {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .opt-card i {
        font-size: 2rem;
        color: #718096;
        margin-bottom: 12px;
        transition: color 0.3s ease;
    }

    .opt-card div {
        font-weight: 600;
        font-size: 0.95rem;
        color: #4a5568;
    }

    /* Active state */
    .opt-card.active {
        border-color: #a7004e;
        background-color: rgba(167, 0, 78, 0.02);
        box-shadow: 0 4px 15px rgba(167, 0, 78, 0.05);
    }

    .opt-card.active i {
        color: #a7004e;
    }

    .opt-card.active div {
        color: #a7004e;
    }

    /* Interactive mock card form style */
    .card-details-form {
        display: none;
        animation: fadeIn 0.4s ease forwards;
        background: #fdfaf6;
        border: 1px dashed #e2e8f0;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 25px;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-field {
        margin-bottom: 15px;
    }

    .form-field label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: #718096;
        margin-bottom: 6px;
    }

    .form-field input {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #cbd5e0;
        border-radius: 8px;
        font-size: 0.9rem;
        outline: none;
        transition: all 0.3s ease;
    }

    .form-field input:focus {
        border-color: #a7004e;
        box-shadow: 0 0 0 3px rgba(167, 0, 78, 0.12);
    }

    .card-grid-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .btn-pay {
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
    }

    .btn-pay:hover {
        background-color: #85003e;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(167, 0, 78, 0.35);
    }

    /* Success Screen */
    .success-screen {
        text-align: center;
        padding: 50px 30px;
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(167, 0, 78, 0.02);
        max-width: 500px;
        margin: 0 auto;
        width: 100%;
        animation: scaleIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    @keyframes scaleIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }

    .success-icon {
        width: 80px;
        height: 80px;
        background: rgba(56, 161, 105, 0.1);
        color: #38a169;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        margin: 0 auto 25px auto;
    }

    .success-screen h2 {
        color: #38a169;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .success-screen p {
        color: #718096;
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 30px;
    }

    .btn-done {
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
        text-decoration: none;
    }

    .btn-done:hover {
        background-color: #85003e;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(167, 0, 78, 0.35);
    }

    @media (max-width: 768px) {
        .payment-container {
            flex-direction: column;
            gap: 20px;
        }
        .summary-panel, .method-panel {
            width: 100%;
        }
        .payment-section {
            padding-top: 120px;
        }
    }
</style>

<div class="payment-section">
    <?php if($payment_success): ?>
        <div class="success-screen">
            <div class="success-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h2>Order Placed!</h2>
            <p>
                Thank you for your order! Your payment has been processed successfully. 
                Our kitchen is getting busy preparing your delicious order now.
            </p>
            <div style="background:#fdfaf6; border:1px solid #edf2f7; border-radius:12px; padding:15px; margin-bottom:30px; text-align:left; font-size:0.9rem;">
                <strong>Order ID:</strong> #<?php echo $order_id; ?><br>
                <strong>Items:</strong> <?php echo $order['product']; ?><br>
                <strong>Total Amount Paid:</strong> RS. <?php echo number_format($order['total'], 2); ?>
            </div>
            <a href="<?php echo SITEURL; ?>Project.php" class="btn-done">Back to Homepage</a>
        </div>
    <?php else: ?>
        <div class="payment-container">
            <!-- Left Side: Order summary -->
            <div class="summary-panel">
                <h3>Order Summary</h3>
                <div class="order-item-list">
                    <div class="order-item-detail">
                        <div class="order-item-title"><?php echo $order['product']; ?></div>
                    </div>
                </div>
                <div class="price-summary-row">
                    <span>Delivery Address</span>
                    <span style="text-align: right; max-width: 150px; font-size: 0.8rem;"><?php echo $order['customer_address']; ?></span>
                </div>
                <div class="price-summary-row">
                    <span>Contact Person</span>
                    <span><?php echo $order['customer_name']; ?></span>
                </div>
                <div class="price-summary-row total">
                    <span>Total Amount</span>
                    <span>RS. <?php echo number_format($order['total'], 2); ?></span>
                </div>
            </div>

            <!-- Right Side: Select payment method -->
            <div class="method-panel">
                <h3>Choose Payment Method</h3>
                <form action="" method="POST" id="payment-form">
                    <input type="hidden" name="payment_method" id="selected-method" value="cod">

                    <div class="payment-options-grid">
                        <div class="opt-card active" onclick="selectMethod('cod')">
                            <i class="fa-solid fa-truck-ramp-box"></i>
                            <div>Cash on Delivery</div>
                        </div>
                        <div class="opt-card" onclick="selectMethod('card')">
                            <i class="fa-regular fa-credit-card"></i>
                            <div>Credit / Debit Card</div>
                        </div>
                    </div>

                    <!-- Hidden Credit Card details form -->
                    <div class="card-details-form" id="card-form-wrapper">
                        <div class="form-field">
                            <label for="card_name">Cardholder's Name</label>
                            <input type="text" id="card_name" placeholder="John Doe">
                        </div>
                        <div class="form-field">
                            <label for="card_num">Card Number</label>
                            <input type="text" id="card_num" placeholder="XXXX XXXX XXXX XXXX" maxlength="19">
                        </div>
                        <div class="card-grid-row">
                            <div class="form-field">
                                <label for="card_exp">Expiry Date</label>
                                <input type="text" id="card_exp" placeholder="MM/YY" maxlength="5">
                            </div>
                            <div class="form-field">
                                <label for="card_cvv">CVV</label>
                                <input type="password" id="card_cvv" placeholder="***" maxlength="3">
                            </div>
                        </div>
                    </div>

                    <button type="submit" name="submit_payment" class="btn-pay" id="pay-button">Place COD Order</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
function selectMethod(method) {
    // Update hidden input
    document.getElementById('selected-method').value = method;

    // Toggle active classes on cards
    const cards = document.querySelectorAll('.opt-card');
    cards.forEach(card => card.classList.remove('active'));

    // Toggle forms and button texts
    const cardForm = document.getElementById('card-form-wrapper');
    const payBtn = document.getElementById('pay-button');

    if (method === 'cod') {
        event.currentTarget.classList.add('active');
        cardForm.style.display = 'none';
        payBtn.innerText = 'Place COD Order';
        
        // Remove required attribute from card fields
        document.getElementById('card_name').required = false;
        document.getElementById('card_num').required = false;
        document.getElementById('card_exp').required = false;
        document.getElementById('card_cvv').required = false;
    } else {
        event.currentTarget.classList.add('active');
        cardForm.style.display = 'block';
        payBtn.innerText = 'Pay & Confirm Order';

        // Add required attribute to card fields
        document.getElementById('card_name').required = true;
        document.getElementById('card_num').required = true;
        document.getElementById('card_exp').required = true;
        document.getElementById('card_cvv').required = true;
    }
}

// Format card number with spaces
const cardInput = document.getElementById('card_num');
if(cardInput) {
    cardInput.addEventListener('input', function (e) {
        e.target.value = e.target.value.replace(/[^\d]/g, '').replace(/(.{4})/g, '$1 ').trim();
    });
}

// Format expiry input exp MM/YY
const expInput = document.getElementById('card_exp');
if(expInput) {
    expInput.addEventListener('input', function (e) {
        e.target.value = e.target.value.replace(/[^\d]/g, '');
        if(e.target.value.length > 2) {
            e.target.value = e.target.value.substr(0, 2) + '/' + e.target.value.substr(2, 2);
        }
    });
}
</script>

<?php include('partials-front/footer.php'); ?>
