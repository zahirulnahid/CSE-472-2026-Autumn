<?php
include "config.php";

$id = (int)$_GET["id"];
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
    $stmt = $conn->prepare("UPDATE students SET student_id=?, name=?, email=?, department=? WHERE id=?");
    $stmt->bind_param("ssssi", $student_id, $name, $email, $department, $id);

    try {
      $stmt->execute();
      header("Location: index.php");
      exit;
    } catch (mysqli_sql_exception $e) {
      $error = "This Student ID already exists";
    }
  }
} else {
  // Load the student's current data
  $result = $conn->query("SELECT * FROM students WHERE id=$id");
  $row = $result->fetch_assoc();
  if (!$row) {
    die("Student not found");
  }
  $student_id = $row["student_id"];
  $name = $row["name"];
  $email = $row["email"];
  $department = $row["department"];
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Student</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="nav">
  <a href="index.php">Students</a>
  <a href="add.php">Add Student</a>
  <a href="register.php">Register</a>
</div>

<div class="box small">
  <h2>Edit Student</h2>
  <p class="error"><?php echo $error; ?></p>

  <form method="post" action="edit.php?id=<?php echo $id; ?>">
    Student ID:
    <input type="text" name="student_id" value="<?php echo $student_id; ?>">
    Name:
    <input type="text" name="name" value="<?php echo $name; ?>">
    Email:
    <input type="text" name="email" value="<?php echo $email; ?>">
    Department:
    <input type="text" name="department" value="<?php echo $department; ?>">
    <input type="submit" value="Update">
  </form>
</div>

</body>
</html>
