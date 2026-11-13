<?php
require "config.php";
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $stmt = $conn->prepare("SELECT id, username, full_name, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["full_name"] = $user["full_name"];
        header("Location: dashboard.php");
        exit;
    } else {
        $msg = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Login | CAT 2</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="card">
  <h1>Login</h1>
  <p class="sub">CNS 3205 Server Administration - CAT 2</p>
  <?php if ($msg) echo "<div class='msg err'>" . htmlspecialchars($msg) . "</div>"; ?>
  <form method="POST" action="login.php">
    <label>Username</label><input type="text" name="username" required>
    <label>Password</label><input type="password" name="password" required>
    <button type="submit">Log In</button>
  </form>
  <div class="links">No account? <a href="register.php">Sign up</a></div>
</div>
</body></html>
