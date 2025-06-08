<?php

session_start();


include 'includes/db.php';
include 'includes/header.php';


if (!isset($_SESSION['user_id'])) {
    echo "<div class='container mt-5'><p class='text-danger'>You must be logged in to view your bookings.</p></div>";
    include 'includes/footer.php';
    exit;
}

$user_id = $_SESSION['user_id'];


$stmt = $conn->prepare("
    SELECT b.*, r.type AS room_type, r.price, r.image
    FROM bookings b
    JOIN rooms r ON b.room_id = r.id
    WHERE b.user_id = ?
    ORDER BY b.check_in DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-5">
  <h2>My Bookings</h2>
  
  <?php if ($result->num_rows === 0): ?>
    <p>You have not made any bookings yet.</p>
  <?php else: ?>
    <div class="row">
      <?php while ($booking = $result->fetch_assoc()): ?>
        <div class="col-md-6">
          <div class="card mb-4 shadow-sm">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="images/<?= htmlspecialchars($booking['image']) ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($booking['room_type']) ?>">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><?= htmlspecialchars($booking['room_type']) ?></h5>
                  <p class="card-text mb-1"><strong>Check-in:</strong> <?= htmlspecialchars($booking['check_in']) ?></p>
                  <p class="card-text mb-1"><strong>Check-out:</strong> <?= htmlspecialchars($booking['check_out']) ?></p>
                  <p class="card-text mb-1"><strong>Name:</strong> <?= htmlspecialchars($booking['name']) ?></p>
                  <p class="card-text mb-1"><strong>Phone:</strong> <?= htmlspecialchars($booking['phone']) ?></p>
                  <p class="card-text"><strong>Address:</strong> <?= nl2br(htmlspecialchars($booking['address'])) ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?> 
