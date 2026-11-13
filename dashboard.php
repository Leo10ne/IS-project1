<?php
require "config.php";
if (!isset($_SESSION["user_id"])) { header("Location: login.php"); exit; }
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Dashboard | CAT 2</title><link rel="stylesheet" href="style.css"></head>
<body>
<nav><strong>CAT 2 Web App</strong><div><a href="dashboard.php">Dashboard</a><a href="feedback.php">Feedback Form</a><a href="logout.php">Logout</a></div></nav>
<div class="card wide">
  <h1>Welcome, <?php echo htmlspecialchars($_SESSION["full_name"]); ?>!</h1>
  <p class="sub">You are logged in as <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong>. Login handled by login.php and verified against the CAT2 database.</p>
  <h2 style="font-size:18px;color:#203a43">Registered users</h2>
  <table>
    <tr><th>ID</th><th>Username</th><th>Full Name</th><th>Email</th><th>Registered</th></tr>
    <?php
    $res = $conn->query("SELECT id, username, full_name, email, created_at FROM users ORDER BY id");
    while ($r = $res->fetch_assoc()) {
        echo "<tr><td>{$r['id']}</td><td>" . htmlspecialchars($r['username']) . "</td><td>" . htmlspecialchars($r['full_name']) . "</td><td>" . htmlspecialchars($r['email']) . "</td><td>{$r['created_at']}</td></tr>";
    }
    ?>
  </table>
</div>
</body></html>
