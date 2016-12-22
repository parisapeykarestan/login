<?php
session_start();

if (isset($_POST['txtUser']) && isset($_POST['txtPass']))
{
$user=$_POST['txtUser'];
$pass=$_POST['txtPass'];

try
{
$db=new PDO("mysql:host=localhost;dbname=siteuser","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$command = "select password from userinfo where username=:userna";
$stmt=$db->prepare($command);
$stmt->bindParam(':userna', $user, PDO::PARAM_STR);
$na=$stmt->execute();
$hashed_password = $stmt->fetchColumn();
if (password_verify($pass, $hashed_password))
 {
   $_SESSION['log']="Accept";
    header("Location:control.php");
}
else
{
    $_SESSION['log']="Failed";
    header("Location:index.htm");
}
}
 catch(PDOException $err)
 {
 }
}
else
{
 // header("Location:index.htm");
}
?>