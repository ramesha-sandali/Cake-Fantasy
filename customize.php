<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customize Your Cake</title>
  <link rel="stylesheet" href="css/stylescus.css">
</head>
<body>
  <div class="form-container">
    <form action="submit_custom_cake.php" method="post" class="custom-cake-form">
      <h2>Customize Your Own Cake</h2>

      <!-- Customer Details -->
      <label for="name">Full Name:</label>
      <input type="text" id="name" name="name" placeholder="Your name" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Your email" required>

      <label for="phone">Phone Number:</label>
      <input type="tel" id="phone" name="phone" placeholder="Your phone number" required>

      <!-- Cake Details -->
      <h3>Cake Details</h3>

      <label for="cake-flavor">Cake Flavor:</label>
      <select id="cake-flavor" name="cake_flavor" required>
        <option value="" disabled selected>Select flavor</option>
        <option value="vanilla">Vanilla</option>
        <option value="chocolate">Chocolate</option>
        <option value="red_velvet">Red Velvet</option>
        <option value="strawberry">Strawberry</option>
        <option value="carrot">Carrot</option>
        <option value="cheesecake">Cheesecake</option>
      </select>

      <label for="frosting">Frosting Type:</label>
      <select id="frosting" name="frosting" required>
        <option value="" disabled selected>Select frosting</option>
        <option value="buttercream">Buttercream</option>
        <option value="whipped_cream">Whipped Cream</option>
        <option value="fondant">Fondant</option>
        <option value="cream_cheese">Cream Cheese</option>
        <option value="ganache">Ganache</option>
      </select>

      <label for="size">Cake Size:</label>
      <select id="size" name="size" required>
        <option value="" disabled selected>Select size</option>
        <option value="6_inch">6-inch (serves 6-8)</option>
        <option value="8_inch">8-inch (serves 10-12)</option>
        <option value="10_inch">10-inch (serves 14-16)</option>
      </select>

      <label for="layers">Number of Layers:</label>
      <select id="layers" name="layers" required>
        <option value="" disabled selected>Select layers</option>
        <option value="1">1 layer</option>
        <option value="2">2 layers</option>
        <option value="3">3 layers</option>
      </select>

      <!-- Customization Details -->
      <h3>Additional Customization</h3>

      <label for="decorations">Decorations:</label>
      <textarea id="decorations" name="decorations" rows="4" placeholder="Describe any decorations, colors, or themes you'd like"></textarea>

      <label for="message">Custom Message on Cake:</label>
      <input type="text" id="message" name="message" placeholder="e.g. Happy Birthday!" maxlength="50">

      <!-- Delivery and Date -->
      <h3>Delivery Information</h3>

      <label for="delivery-date">Preferred Delivery Date:</label>
      <input type="date" id="delivery-date" name="delivery_date" required>

      <label for="delivery-address">Delivery Address:</label>
      <textarea id="delivery-address" name="delivery_address" rows="3" placeholder="Your delivery address" required></textarea>

      <!-- Submit Button -->
      <button type="submit">Submit Order</button>
    </form>
  </div>
</body>
</html>