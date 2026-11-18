<?php
include "config.php";

$name = $email = "";
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $pass = $_POST["password"];

  if (empty($name) || empty($email) || empty($pass)) {
    $error = "All fields are required";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format";
  } elseif (strlen($pass) < 6) {
    $error = "Password must be at least 6 characters";
  } else {
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hash);

    try {
      $stmt->execute();
      $success = "Registration successful!";
      $name = $email = "";
    } catch (mysqli_sql_exception $e) {
      $error = "This email is already registered";
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="nav">
  <a href="index.php">Students</a>
  <a href="add.php">Add Student</a>
  <a href="register.php">Register</a>
</div>

<div class="box small">
  <h2>Register</h2>
  <p class="error"><?php echo $error; ?></p>
  <p class="success"><?php echo $success; ?></p>

  <form method="post" action="register.php">
    Full Name:
    <input type="text" name="name" value="<?php echo $name; ?>">
    Email:
    <input type="text" name="email" value="<?php echo $email; ?>">
    Password:
    <input type="password" name="password">
    <input type="submit" value="Register">
  </form>
</div>

</body>
</html>
