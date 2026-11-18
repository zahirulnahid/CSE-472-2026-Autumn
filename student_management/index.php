<?php
include "config.php";

$sql = "SELECT * FROM students ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Management</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="nav">
  <a href="index.php">Students</a>
  <a href="add.php">Add Student</a>
  <a href="register.php">Register</a>
</div>

<div class="box">
  <h2>All Students</h2>

  <table>
    <tr>
      <th>Student ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Department</th>
      <th>Action</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["student_id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["department"] . "</td>";
        echo "<td>
                <a href='edit.php?id=" . $row["id"] . "'>Edit</a> |
                <a href='delete.php?id=" . $row["id"] . "' onclick=\"return confirm('Delete this student?')\">Delete</a>
              </td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='5'>No students found</td></tr>";
    }
    $conn->close();
    ?>
  </table>
</div>

</body>
</html>
