<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link rel="stylesheet" href="stylesloc.css">
</head>
<body>

  <!-- Contact Section -->
  <section class="contact-section">
    <div class="container">
      <div class="form-container">
        <h2>Contact Us</h2>
        <form action="#" method="POST">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" required></textarea>
          </div>
          <button type="submit" class="btn">Submit</button>
        </form>
      </div>
      
      <div class="map-container">
        <h2>Find Us</h2>
        <div id="map"></div>
      </div>
    </div>
  </section>

  <script>
    // Initialize and add the map
    function initMap() {
      const location = {"<iframe src="https:/www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1520.938260768125!2d79.82892194290797!3d7.666955732095473!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2slk!4v1729554753740!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>"} // Replace with your location
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 8,
        center: location,
      });
      const marker = new google.maps.Marker({
        position: location,
        map: map,
      });
    }
  </script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap">
  </script>

</body>
</html>

