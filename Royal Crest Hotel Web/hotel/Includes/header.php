<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Royal Crest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/hotel/css/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold fs-3 text-white" href="new.php">
      
      Royal Crest
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
        <li class="nav-item me-2">
          <a href="index.php" class="btn btn-outline-light btn-sm rounded-pill px-3">Rooms</a>
        </li>
        <li class="nav-item me-2">
          <a href="contact us.php" class="btn btn-outline-light btn-sm rounded-pill px-3">Contact Us</a>
        </li>
        <?php if (isset($_SESSION['user_id'])): ?>
          <li class="nav-item me-2">
            <span class="text-white-50 small">Hello, <?= htmlspecialchars($_SESSION['user_name']) ?>!</span>
          </li>
          <li class="nav-item me-2">
            <a href="my_bookings.php" class="btn btn-outline-light btn-sm rounded-pill px-3">My Bookings</a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="btn btn-outline-danger btn-sm rounded-pill px-3">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item me-2">
            <a href="register.php" class="btn btn-outline-light btn-sm rounded-pill px-3">Register</a>
          </li>
          <li class="nav-item">
            <a href="login.php" class="btn btn-light btn-sm rounded-pill px-3">Login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
