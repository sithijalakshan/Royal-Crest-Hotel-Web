<?php
include 'includes/db.php';
include 'includes/header.php'; 


$room_id   = $_POST['room_id'];
$name      = $_POST['name'];
$email     = $_POST['email'];
$phone     = $_POST['phone'];
$address   = $_POST['address'];
$check_in  = $_POST['check_in'];
$check_out = $_POST['check_out'];

$booking_successful = false; 

$conn->begin_transaction();

try {
    
    $stmt = $conn->prepare("SELECT available_rooms, price FROM rooms WHERE id = ? FOR UPDATE");
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $stmt->bind_result($available_rooms, $price_per_night);
    $stmt->fetch();
    $stmt->close();

    if ($available_rooms <= 0) {
        throw new Exception("Sorry, this room is fully booked.");
    }

    
    $checkInDate  = new DateTime($check_in);
    $checkOutDate = new DateTime($check_out);
    $nights = $checkInDate->diff($checkOutDate)->days;

    if ($nights <= 0) {
        throw new Exception("Check-out date must be after check-in.");
    }

    $room_charge = $nights * $price_per_night;
    $fees        = 10.40;
    $taxes       = 25.31;
    $total_price = $room_charge + $fees + $taxes;

    
    $sql = "INSERT INTO bookings (room_id, name, email, phone, address, check_in, check_out)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $room_id, $name, $email, $phone, $address, $check_in, $check_out);
    $stmt->execute();
    $stmt->close();

   
    $stmt = $conn->prepare("UPDATE rooms SET available_rooms = available_rooms - 1 WHERE id = ?");
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $stmt->close();

    
    $conn->commit();
    $booking_successful = true;

} catch (Exception $e) {
    $conn->rollback();
    echo "<h3>❌ Booking failed: " . $e->getMessage() . "</h3>";
    echo '<a href="index.php">Back to rooms list</a>';
}

$conn->close();
?>

<?php if ($booking_successful): ?>

<div style="max-width: 500px; margin: auto; border-top: 3px solid #002244; padding-top: 15px; font-family: Arial;">
  <h2>Payment and Guest Details</h2>

  <h3 style="color: #002244;">
    Total for stay <span style="float: right;">$<?= number_format($total_price, 2) ?></span>
  </h3>

  <p>Total room charge <span style="float: right;">$<?= number_format($room_charge, 2) ?></span></p>
  <p>Total fees <span style="float: right;">$<?= number_format($fees, 2) ?></span></p>
  <p>Total taxes <span style="float: right;">$<?= number_format($taxes, 2) ?></span></p>
  <p style="color: gray; font-size: 12px;">Price in $USD</p>

  <hr>

  
  <h3><i class="fa fa-credit-card"></i> Payment</h3>
  <label>Card number</label><br>
  <input type="text" name="card_number" style="width: 100%; padding: 10px; border: 1px solid #ccc;"><br>
  <span style="color: red; font-size: 13px;">❌ Please enter a valid card number.</span><br><br>

  <label>Month</label>
  <select name="exp_month">
    <option value="">--</option>
    <?php for ($m = 1; $m <= 12; $m++): ?>
      <option value="<?= $m ?>"><?= str_pad($m, 2, '0', STR_PAD_LEFT) ?></option>
    <?php endfor; ?>
  </select>

  <label>Year</label>
  <select name="exp_year">
    <option value="">--</option>
    <?php for ($y = date("Y"); $y <= date("Y") + 10; $y++): ?>
      <option value="<?= $y ?>"><?= $y ?></option>
    <?php endfor; ?>
  </select>
<style>
  .btn-success {
    background-color: #28a745;
    color: white;
    padding: 10px;
    border: none;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
  }
  .btn-success:hover {
    background-color: #218838;
  }
</style>



  <br> <br>
  <a href="index.php">Back to rooms list</a>
</div>
<form action="payment_processing.php" method="POST">
  
  <input type="hidden" name="amount" value="<?= number_format($total_price, 2, '.', '') ?>">
  <input type="hidden" name="name" value="<?= htmlspecialchars($name) ?>">
  <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">

  <div style="text-align: center; margin-top: 20px;">
  <button type="submit" class="btn btn-success" style="min-width: 10px; padding: 8px 20px;">
    💳 Pay Now
  </button>
</div>

</form>





<?php endif; ?>

<?php include 'includes/footer.php'; ?>