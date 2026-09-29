<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link rel="stylesheet" href="css/stylecon.css">
  <link href='https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap' rel='stylesheet'>
</head>
<body>
    <section id="Contact">
        <div class="contact-form-container">
            <h2>Contact Us</h2>
            <p>Have any questions? Reach out to us!</p>
            
            <!-- Contact Form -->
            <form action="submit_form.php" method="post">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </div>
        <div class="contact-form-container">
            <!-- Location Section -->
            <div class="location">
                <h3>Our Location</h3><br>
                <p>Railway Station Road, Arachchikattuwa, Chilaw</p><br>
                <!-- Embed Google Map -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d384.87372009086573!2d79.8302232153963!3d7.668275804743187!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2slk!4v1730958313378!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
</body>
</html>




