<?php
include "config.php";

$id = (int)$_GET["id"];

$sql = "DELETE FROM students WHERE id=$id";
$conn->query($sql);
$conn->close();

header("Location: index.php");
exit;
?>
