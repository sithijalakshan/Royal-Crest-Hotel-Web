<?php
include 'includes/db.php';
include 'includes/header.php'; 

$room_id = $_GET['id'] ?? null;
if (!$room_id) {
    die("No room selected.");
}

$stmt = $conn->prepare("SELECT * FROM rooms WHERE id = ?");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$room = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$room) {
    die("Room not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title><?= htmlspecialchars($room['type']) ?> - Room Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
  <div class="container my-5">
    <a href="index.php" class="btn btn-secondary mb-4">← Back to Rooms</a>

    <div class="row">
      <div class="col-md-6">
        <?php if ($room['image']) { ?>
          <img src="<?= htmlspecialchars($room['image']) ?>" alt="<?= htmlspecialchars($room['type']) ?>" class="img-fluid rounded shadow-sm" />
        <?php } ?>
      </div>
      <div class="col-md-6">
        <h2><?= htmlspecialchars($room['type']) ?></h2>
        <p><strong>Price:</strong> $<?= number_format($room['price'], 2) ?> / night</p>
        <p><?= nl2br(htmlspecialchars($room['description'])) ?></p>
        <p><strong>Total Rooms:</strong> <?= $room['total_rooms'] ?></p>
        <p><strong>Available Rooms:</strong> <?= $room['available_rooms'] ?></p>

        <?php if ($room['available_rooms'] > 0) { ?>
          <hr />
          <h4>Book This Room</h4>

          <form action="save-booking.php" method="POST" class="mt-3">
            <input type="hidden" name="room_id" value="<?= $room['id'] ?>" />

            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" id="name" name="name" class="form-control" required />
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" class="form-control" required />
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">Phone</label>
              <input type="text" id="phone" name="phone" class="form-control" required />
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <textarea id="address" name="address" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
              <label for="check_in" class="form-label">Check-In Date</label>
              <input type="date" id="check_in" name="check_in" class="form-control" required />
            </div>

            <div class="mb-3">
              <label for="check_out" class="form-label">Check-Out Date</label>
              <input type="date" id="check_out" name="check_out" class="form-control" required />
            </div>

            <button type="submit" class="btn btn-success">Confirm Booking</button>
          </form>
        <?php } else { ?>
          <div class="alert alert-warning mt-4">
            Sorry, no rooms are available for this type at the moment.
          </div>
        <?php } ?>

      </div>
    </div>
  </div>
</body>
</html>

<?php include 'includes/footer.php'; ?>
