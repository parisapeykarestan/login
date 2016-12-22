<!DOCTYPE html>
<?php
session_start();
if($_SESSION['log']!="Accept")
{
  header("Location:index.htm");
}
 ?>
<html>

<head>
  <title>Hello!</title>
</head>

<body>
<h1>Site Control Panel</h1>
<a href="logout.php">SignOut</a>
<?php

?>

</body>
</html>