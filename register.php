<?php
require "config.php";
$msg = ""; $type = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    if ($password !== $confirm) {
        $msg = "Passwords do not match."; $type = "err";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, full_name, email, phone, password) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $username, $full_name, $email, $phone, $hash);
        if ($stmt->execute()) {
            $msg = "Account created for $username. You can now log in."; $type = "ok";
        } else {
            $msg = "Error: username or email already exists."; $type = "err";
        }
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Sign Up | CAT 2</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="card">
  <h1>Create Account</h1>
  <p class="sub">CNS 3205 Server Administration - CAT 2</p>
  <?php if ($msg) echo "<div class='msg $type'>" . htmlspecialchars($msg) . "</div>"; ?>
  <form method="POST" action="register.php">
    <label>Username</label><input type="text" name="username" required>
    <label>Full Name</label><input type="text" name="full_name" required>
    <label>Email</label><input type="email" name="email" required>
    <label>Phone</label><input type="text" name="phone">
    <label>Password</label><input type="password" name="password" required>
    <label>Confirm Password</label><input type="password" name="confirm" required>
    <button type="submit">Sign Up</button>
  </form>
  <div class="links">Already registered? <a href="login.php">Log in</a></div>
</div>
</body></html>
