

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirm Order</title>
  <link rel="stylesheet" href="styleconf.css">
</head>
<body>

  <!-- Add to Cart Button -->
  <button id="addToCartBtn">Add to Cart</button>

  <!-- Confirmation Order Form (Initially hidden) -->
  <div id="confirmOrderModal" class="modal">
    <div class="modal-content">
      <span id="closeBtn" class="close">&times;</span>
      <h2>Confirm Your Order</h2>

      <!-- Form to confirm order -->
      <form id="confirmOrderForm">
        <label for="itemName">Item Name:</label>
        <input type="text" id="itemName" name="itemName" value="Cake" readonly><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="1" min="1"><br><br>

        <label for="totalPrice">Total Price:</label>
        <input type="text" id="totalPrice" name="totalPrice" value="$20" readonly><br><br>

        <button type="submit" id="confirmOrderBtn">Confirm Order</button>
      </form>
    </div>
  </div>

  <script src="script2.js"></script>
</body>
</html>

