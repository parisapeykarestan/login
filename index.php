<?php
 session_start();

if (isset($_POST['txtUser']) && isset($_POST['txtPass'])) {
    $user = $_POST['txtUser'];
    $pass = $_POST['txtPass'];

    try {
        $db = new PDO("mysql:host=localhost;dbname=user", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $command = "select password from members where username=:userna";
        $stmt = $db->prepare($command);
        $stmt->bindParam(':userna', $user, PDO::PARAM_STR);
        $na = $stmt->execute();
        $hashed_password = $stmt->fetchColumn();
        if (password_verify($pass, $hashed_password)) {
            $_SESSION['log'] = "Accept";

        } else {
            $_SESSION['log'] = "Failed";
            header("Location:index.htm");
        }
    } catch (PDOException $err) {
    }
}
 ?>


<!DOCTYPE html>

<html>

<head>
  <title>Hello!</title>
</head>

<body>
  <link href="css/font.css" rel='stylesheet' type='text/css'>
    <div class="container">
      <div class="profile">
        <button class="profile__avatar" id="toggleProfile">
         <img src="http://up.ashiyane.org/images/7l1ppcik2cwlfr00z8d.jpg" alt="Avatar" />
        </button>
        <form class="profile__form" action="index.php" method="POST">
          <div class="profile__fields">
            <div class="field">
              <input name="username" type="text" id="fieldUser" class="input" required pattern=.*\S.* />
              <label for="fieldUser" class="label">Username</label>
            </div>
            <div class="field">
              <input  name="password" type="password" id="fieldPassword" class="input" required pattern=.*\S.* />
              <label for="fieldPassword" class="label">Password</label>
            </div>
            <div class="profile__footer">
              <button class="btn" type="submit">Login</button>
            </div>
          </div>
         </div>
      </form>
    </div>
  <script src="js/index.js"></script>
  </body>
</html>