<?php include('partials-front/menu.php'); ?>

<?php
  $is_direct_checkout = false;

  //check whether product id is set or not
  if(isset($_GET['product_id']))
  {
    $is_direct_checkout = true;
    $product_id = (int)$_GET['product_id'];

    //get the details of selected items
    $sql = "SELECT * FROM tbl_cakes WHERE id=$product_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count==1)
    {
      $row = mysqli_fetch_assoc($res);
      $title = $row['title'];
      $price = $row['price'];
      $image_name = $row['image_name'];
      $qty = 1;
    }
    else{
      header('location:'.SITEURL);
      exit();
    }
  }
  else if(isset($_SESSION['cart']) && !empty($_SESSION['cart']))
  {
    // Checkout from cart
    $cart_titles = [];
    $total_price = 0;
    $image_name = "";

    foreach($_SESSION['cart'] as $item_id => $q) {
      $sql = "SELECT * FROM tbl_cakes WHERE id=$item_id";
      $res = mysqli_query($conn, $sql);
      if($res && mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $cart_titles[] = $row['title'] . " (x" . $q . ")";
        $total_price += $row['price'] * $q;
        if(empty($image_name)) {
          $image_name = $row['image_name']; // Use the first item's image
        }
      }
    }

    if(count($cart_titles) == 0) {
      header('location:'.SITEURL.'cart.php');
      exit();
    }

    $title = implode(', ', $cart_titles);
    $price = $total_price; // Store grand total as unit price
    $qty = 1;             // Set quantity to 1 so unit price * qty = grand total
  }
  else{
    header('location:'.SITEURL.'cart.php');
    exit();
  }
?>

<style>
  /* Page background and general resets for checkout */
  body {
    background-color: #fdfaf6; /* Soft warm cream background */
    color: #2d3748;
    font-family: 'Raleway', sans-serif;
  }

  /* Checkout content padding to prevent fixed navbar overlap */
  .food-search {
    padding-top: 150px;
    padding-bottom: 80px;
    min-height: 100vh;
  }

  .food-search h2 {
    font-size: 2.2rem;
    font-weight: 700;
    color: #a7004e; /* System deep pink */
    margin-bottom: 40px;
    font-family: 'Raleway', sans-serif;
    letter-spacing: -0.5px;
  }

  /* Container wrapper */
  .checkout-container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 20px;
    width: 100%;
  }

  /* Form layout: 2-column flexbox grid */
  .order {
    display: flex;
    flex-direction: row;
    gap: 40px;
    align-items: flex-start;
    flex-wrap: wrap;
  }

  /* Style fieldsets as clean card components */
  .order fieldset {
    flex: 1;
    min-width: 320px;
    border: 1px solid #e2e8f0;
    background-color: #ffffff;
    border-radius: 20px;
    padding: 35px 30px;
    box-shadow: 0 10px 30px rgba(167, 0, 78, 0.02), 0 1px 8px rgba(0, 0, 0, 0.01);
    margin-bottom: 20px;
  }

  /* Style legend as a section header */
  .order legend {
    color: #a7004e;
    font-weight: 700;
    font-size: 1.25rem;
    padding: 0 12px;
    font-family: 'Raleway', sans-serif;
    letter-spacing: -0.2px;
    float: left;
    width: 100%;
    margin-bottom: 25px;
    border-bottom: 1px solid #edf2f7;
    padding-bottom: 10px;
  }

  /* Product details layout */
  .food-menu-img {
    text-align: center;
    margin-bottom: 25px;
  }

  .food-menu-img img {
    max-width: 260px;
    width: 100%;
    height: auto;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .food-menu-img img:hover {
    transform: scale(1.02);
  }

  .food-menu-desc {
    text-align: center;
  }

  .food-menu-desc h3 {
    font-family: 'Raleway', sans-serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 10px;
  }

  .food-price {
    font-size: 1.35rem;
    font-weight: 700;
    color: #a7004e;
    margin-bottom: 25px;
  }

  /* Inputs and textareas */
  .order-label {
    font-size: 0.88rem;
    font-weight: 600;
    color: #4a5568;
    margin-bottom: 8px;
    letter-spacing: 0.2px;
  }

  .input-responsive {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #cbd5e0;
    border-radius: 10px;
    font-size: 0.95rem;
    color: #2d3748;
    background-color: #fafbfc;
    font-family: inherit;
    transition: all 0.3s ease;
    margin-bottom: 20px;
    outline: none;
  }

  .input-responsive:focus {
    border-color: #a7004e;
    background-color: #ffffff;
    box-shadow: 0 0 0 3px rgba(167, 0, 78, 0.12);
  }

  textarea.input-responsive {
    min-height: 120px;
    resize: vertical;
  }

  /* Quantity input width restriction */
  input[name="qty"] {
    max-width: 120px;
    text-align: center;
    margin: 0 auto 20px auto;
    display: block;
  }

  /* Order submit button */
  .btn-primary {
    background-color: #a7004e;
    color: #ffffff !important;
    border: none;
    padding: 15px 30px;
    font-size: 1rem;
    font-weight: 700;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 14px rgba(167, 0, 78, 0.2);
    margin-top: 10px;
    font-family: inherit;
  }

  .btn-primary:hover {
    background-color: #85003e;
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(167, 0, 78, 0.35);
  }

  .btn-primary:active {
    transform: translateY(1px);
  }

  /* Responsive layout adjustment for small screens */
  @media (max-width: 768px) {
    .order {
      flex-direction: column;
      gap: 20px;
    }
    .order fieldset {
      width: 100%;
    }
    .food-search {
      padding-top: 120px;
    }
  }
</style>

<section class="food-search">
    <div class="checkout-container">
        
        <h2 class="text-center">Confirm Your Order</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Product</legend>

                <div class="food-menu-img">
                    <img src="<?php echo SITEURL; ?>images/<?php echo $image_name; ?>" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h3 style="font-size: 1.1rem; line-height: 1.4; max-height: 100px; overflow-y: auto;"><?php echo $title; ?></h3>
                    <input type="hidden" name="product" value="<?php echo $title; ?>">
                    <p class="food-price">RS. <?php echo number_format($price, 2); ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <?php if ($is_direct_checkout): ?>
                        <input type="number" name="qty" class="input-responsive" value="1" min="1" required>
                    <?php else: ?>
                        <input type="number" name="qty" class="input-responsive" value="1" readonly style="background-color: #f7fafc; cursor: not-allowed; color:#a0aec0;">
                        <span style="font-size: 0.8rem; color: #718096; display: block; margin-top: -15px; margin-bottom: 20px; text-align: center;">Quantity managed in cart</span>
                    <?php endif; ?>
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Delivery Details</legend>
                
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Ramesha Sandali" class="input-responsive" value="<?php echo isset($_SESSION['customer_name']) ? $_SESSION['customer_name'] : ''; ?>" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 94-07xxxxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. xxx@gmail.com" class="input-responsive" value="<?php echo isset($_SESSION['customer_email']) ? $_SESSION['customer_email'] : ''; ?>" required>

                <div class="order-label">Address</div>
                <textarea name="address" placeholder="E.g. Street, City" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn-primary">
            </fieldset>
        </form>

        <?php
          //check whether submit is clicked or not
          if(isset($_POST['submit']))
          {
            //get all the details form form
            $product = mysqli_real_escape_string($conn, $_POST['product']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $qty = mysqli_real_escape_string($conn, $_POST['qty']);
            $total = $price * $qty;

            $order_date = date("Y-m-d H:i:s");

            $status = "Ordered";

            $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
            $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
            $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
            $customer_address = mysqli_real_escape_string($conn, $_POST['address']);

            //save the order in database
            $sql2 = "INSERT INTO tbl_order SET
              product = '$product',
              price = '$price',
              qty = '$qty',
              total = '$total',
              order_date = '$order_date',
              status = '$status',
              customer_name = '$customer_name',
              customer_contact = '$customer_contact',
              customer_email = '$customer_email',
              customer_address = '$customer_address'
            ";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);

            //check the query executed
            if($res2==true)
            {
              $order_id = mysqli_insert_id($conn);
              echo "<script> alert('Order details confirmed! Proceeding to payment.'); </script>";
              echo "<script> window.location.href='" . SITEURL . "payment.php?order_id=" . $order_id . "'; </script>";
            }
            else{
              $_SESSION['order'] = "<div class='success'>Product Ordered Unsuccessfully.</div>";
              header('location:'.SITEURL);
            }
          }
        ?>

    </div>
</section>

<?php include('partials-front/footer.php'); ?>
