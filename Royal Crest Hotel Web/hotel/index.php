<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>
<body>
<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Royal Crest</a>
</nav> -->
<!-- <div class="container mt-4">
</div> -->

<!-- <header>
    <div class="logo">Rooms</div>
    <style>
        .logo {
      font-size: 24px;
      font-weight: bold;
    }
    </style>

</header> -->
<?php
// Fetch available rooms from the database
// Fetch all rooms
$result = $conn->query("SELECT * FROM rooms");
if (!$result) {
    die("Query failed: " . $conn->error);
} 
?>
<div class="container my-5">
    <h2 class="mb-4 text-center fw-bold text-primary">Available Rooms</h2>
    <div class="row g-4">
      <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
          <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden">
            <?php 
              $imagePath = $row['image'] ? $row['image'] : 'hotel web photos/images/360_F_277685543_bZy10zzHIR8wjLRd5NUCgYMZQadEDGWe.jpg';
            ?>
            <img src="<?= $imagePath ?>" class="card-img-top" style="height: 220px; object-fit: cover; border-bottom: 4px solid #0d6efd;" alt="Room Image">
            <div class="card-body d-flex flex-column justify-content-between">
              <div>
                <h5 class="card-title mb-2 text-primary-emphasis fw-semibold"><?= htmlspecialchars($row['type']) ?></h5>
                <p class="card-text text-secondary small mb-3" style="min-height: 60px;">
                  <?= htmlspecialchars($row['description']) ?>
                </p>
              </div>
              <div class="mt-auto">
                <p class="mb-2"><span class="badge bg-success fs-6">$<?= number_format($row['price'], 2) ?> / night</span></p>
                <a href="room-details.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary w-100 rounded-pill fw-bold">View & Book</a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>


</body>
</html>
<?php include 'includes/footer.php'; ?>