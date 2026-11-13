<?php
require "config.php";
if (!isset($_SESSION["user_id"])) { header("Location: login.php"); exit; }
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $course = $_POST["course"];
    $rating = (int)$_POST["rating"];
    $message = trim($_POST["message"]);
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, course, rating, message) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssis", $name, $email, $course, $rating, $message);
    $msg = $stmt->execute() ? "Feedback submitted (POST) and saved to the feedback table." : "Error saving feedback.";
}
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Course Feedback | CAT 2</title><link rel="stylesheet" href="style.css"></head>
<body>
<nav><strong>CAT 2 Web App</strong><div><a href="dashboard.php">Dashboard</a><a href="feedback.php">Feedback Form</a><a href="logout.php">Logout</a></div></nav>
<div class="card wide">
  <h1>Course Feedback Form</h1>
  <p class="sub">Submits via POST to the <strong>feedback</strong> table in the CAT2 database.</p>
  <?php if ($msg) echo "<div class='msg ok'>" . htmlspecialchars($msg) . "</div>"; ?>
  <form method="POST" action="feedback.php">
    <label>Name</label><input type="text" name="name" value="<?php echo htmlspecialchars($_SESSION['full_name']); ?>" required>
    <label>Email</label><input type="email" name="email" required>
    <label>Course</label>
    <select name="course">
      <option>CNS 3205 Server Administration</option>
      <option>CNS 4204 Privacy Enhancing Technologies</option>
      <option>CNS 4206 Blockchain Technology</option>
    </select>
    <label>Rating (1-5)</label><input type="number" name="rating" min="1" max="5" value="5" required>
    <label>Message</label><textarea name="message" required></textarea>
    <button type="submit">Submit Feedback</button>
  </form>
</div>
<div class="card wide">
  <h1>Submitted Feedback (retrieved from database)</h1>
  <table>
    <tr><th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Rating</th><th>Message</th><th>Submitted</th></tr>
    <?php
    $res = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
    while ($r = $res->fetch_assoc()) {
        echo "<tr><td>{$r['id']}</td><td>" . htmlspecialchars($r['name']) . "</td><td>" . htmlspecialchars($r['email']) . "</td><td>" . htmlspecialchars($r['course']) . "</td><td>{$r['rating']}</td><td>" . htmlspecialchars($r['message']) . "</td><td>{$r['created_at']}</td></tr>";
    }
    ?>
  </table>
</div>
</body></html>
