<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      min-height: 100vh;
      margin: 0;
    }
    .sidebar {
      width: 220px;
      background-color: #343a40;
      color: white;
      flex-shrink: 0;
    }
    .sidebar h4 {
      padding: 15px;
      border-bottom: 1px solid #495057;
      text-align: center;
    }
    .sidebar a {
      display: block;
      padding: 12px 20px;
      color: white;
      text-decoration: none;
    }
    .sidebar a:hover, .sidebar .active {
      background-color: #495057;
    }
    .content {
      flex-grow: 1;
      padding: 20px;
      background-color: #f8f9fa;
    }
  </style>
</head>
<body>


<div class="sidebar">
  <h4>Admin Panel</h4>
  <a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a>
  <a href="users.php" class="<?= basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : '' ?>">Users</a>
  <a href="hotels.php" class="<?= basename($_SERVER['PHP_SELF']) == 'hotels.php' ? 'active' : '' ?>">Hotels</a>
  <a href="add_room.php" class="<?= basename($_SERVER['PHP_SELF']) == 'add_hotel.php' ? 'active' : '' ?>">Add Room</a>
  <a href="bookings.php" class="<?= basename($_SERVER['PHP_SELF']) == 'bookings.php' ? 'active' : '' ?>">Bookings</a>
  <a href="reviews.php" class="<?= basename($_SERVER['PHP_SELF']) == 'reviews.php' ? 'active' : '' ?>">Reviews</a>
  <a href="../logout.php">Logout</a>
</div>

</body>
<div class="content">
</html>