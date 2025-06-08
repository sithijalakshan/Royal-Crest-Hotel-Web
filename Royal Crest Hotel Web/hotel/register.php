<?php
include 'includes/db.php';
include 'includes/header.php';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if (empty($name) || empty($email) || empty($_POST["password"])) {
        $error = "All fields are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        if ($stmt->execute()) {
            $success = "Registration successful. You can now <a href='login.php'>login</a>.";
        } else {
            $error = "Registration failed: " . $stmt->error;

        }
    }
}
?>

<div class="container mt-5">
  <h2>User Registration</h2>
  <?php if ($success) echo "<div class='alert alert-success'>$success</div>"; ?>
  <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>

  <form method="POST" class="mt-3">
    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
  </form>
</div>











<?php
include 'includes/footer.php';
?>
