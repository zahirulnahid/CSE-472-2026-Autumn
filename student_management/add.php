<?php
include "config.php";

$student_id = $name = $email = $department = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $student_id = test_input($_POST["student_id"]);
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $department = test_input($_POST["department"]);

  if (empty($student_id) || empty($name) || empty($email) || empty($department)) {
    $error = "All fields are required";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format";
  } else {
    $stmt = $conn->prepare("INSERT INTO students (student_id, name, email, department) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $student_id, $name, $email, $department);

    try {
      $stmt->execute();
      header("Location: index.php");
      exit;
    } catch (mysqli_sql_exception $e) {
      $error = "This Student ID already exists";
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Student</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="nav">
  <a href="index.php">Students</a>
  <a href="add.php">Add Student</a>
  <a href="register.php">Register</a>
</div>

<div class="box small">
  <h2>Add Student</h2>
  <p class="error"><?php echo $error; ?></p>

  <form method="post" action="add.php">
    Student ID:
    <input type="text" name="student_id" value="<?php echo $student_id; ?>">
    Name:
    <input type="text" name="name" value="<?php echo $name; ?>">
    Email:
    <input type="text" name="email" value="<?php echo $email; ?>">
    Department:
    <input type="text" name="department" value="<?php echo $department; ?>">
    <input type="submit" value="Save">
  </form>
</div>

</body>
</html>
