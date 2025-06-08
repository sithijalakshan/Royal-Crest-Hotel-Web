<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'booking_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>




<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<meta charset="UTF-8">
  <title>Royal Crest</title>




   <style>
    .hero-section {
      background-image: url('hotel web photos/images/balkan_5465z.jpg');
      background-size: cover;
      background-position: center;
      color: white;
      min-height: 80vh;
      position: relative;
    }
    .overlay {
      position: absolute;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(120deg, rgba(2,27,48,0.55) 60%, rgba(13,110,253,0.25) 100%);
      z-index: 1;
    }
    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 800px;
    }
    .text-shadow {
      text-shadow: 0 2px 8px rgba(0,0,0,0.25);
    }
    .form-inline-custom {
      display: flex;
      gap: 10px;
      justify-content: center;
      margin-top: 20px;
    }
  </style>

  <section class="hero-section position-relative d-flex align-items-center justify-content-center" style="min-height: 80vh;">
  <div class="overlay"></div>
  <div class="hero-content text-center">
    <h1 class="display-2 fw-bold mb-3 text-shadow" style="letter-spacing:2px;">Royal Crest</h1>
    <p class="lead mb-4 fs-4 text-shadow">A boutique hotel experience where comfort meets luxury.</p>
    <a href="index.php" class="btn btn-primary btn-lg rounded-pill px-5 shadow">Find Your Room</a>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <div class="row">

      
      <div class="col-md-6 mb-4 mb-md-0">
        <h2 class="text-primary">Welcome to Royal Crest </h2>
        <p>
          Experience timeless elegance and modern comfort at Royal Crest. Nestled in a serene location, our hotel offers premium rooms, fine dining, and personalized service — ideal for both leisure and business travelers. Whether you’re here for a relaxing getaway or a special event, Royal Crest is your perfect retreat.
        </p>
      </div>

      
      <div class="col-md-6 border-start ps-md-4">
        <h3 class="text-primary">Our amenities</h3>
        <div class="row row-cols-2 gy-2 mt-3">

          
          <div class="col"><i class="fas fa-door-open me-2"></i> Connecting Rooms</div>
          <div class="col"><i class="fas fa-parking me-2"></i> Free parking</div>
          <div class="col"><i class="fas fa-wifi me-2"></i> Free WiFi</div>
          <div class="col"><i class="fas fa-key me-2"></i> Digital Key</div>
          <div class="col"><i class="fas fa-concierge-bell me-2"></i> Concierge</div>
          <div class="col"><i class="fas fa-couch me-2"></i> Executive lounge</div>
          <div class="col"><i class="fas fa-utensils me-2"></i> On-site restaurant</div>
          <div class="col"><i class="fas fa-swimming-pool me-2"></i> Outdoor pool</div>
          <div class="col"><i class="fas fa-concierge-bell me-2"></i> Room service</div>
          <div class="col"><i class="fas fa-users me-2"></i> Meeting rooms</div>
          <div class="col"><i class="fas fa-dumbbell me-2"></i> Fitness center</div>
          

        </div>

        <a href="index.php" class="btn btn-outline-primary mt-4">Find Rooms</a>
      </div>
    </div>
  </div>
</section>

<section class="py-5 text-center bg-white">
  <div class="container">
    <h2 class="text-primary mb-4">Hotel policies</h2>
    <div class="row justify-content-center g-4">

      
      <div class="col-6 col-md-3">
        <div class="p-3">
          <i class="fas fa-parking fa-2x mb-2"></i>
          <div><strong>Parking</strong></div>
        </div>
      </div>

      
      <div class="col-6 col-md-3">
        <div class="p-3">
          <i class="fas fa-dog fa-2x mb-2"></i>
          <div><strong>Pets</strong></div>
        </div>
      </div>

      
      <div class="col-6 col-md-3">
        <div class="p-3">
          <i class="fas fa-smoking fa-2x  mb-2"></i>
          <div><strong>Smoking</strong></div>
        </div>
      </div>

      
      <div class="col-6 col-md-3">
        <div class="p-3">
          <i class="fas fa-wifi fa-2x mb-2"></i>
          <div><strong>WiFi</strong></div>
        </div>
      </div>

    </div>
  </div>
</section>






<div class="container mt-4">
</div>
</body>
</html>
<?php include 'includes/footer.php'; ?>
