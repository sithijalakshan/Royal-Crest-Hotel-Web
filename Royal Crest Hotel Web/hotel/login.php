<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'includes/db.php';
include 'includes/header.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
 

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['Password'])) {  
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['Name'];
        header("Location: index.php");
        exit;
    } else {
        if (!$user) {
            $error = "No user found with that email.";
        } else {
            $error = "Incorrect password.";
        }
    }
}

?>

<div class="container mt-5">
  <h2>User Login</h2>
  <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>

  <form method="POST" class="mt-3">
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
