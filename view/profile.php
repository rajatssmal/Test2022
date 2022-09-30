<?php
session_start();

if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");
}
else {
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
 
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Welcome <?= $first_name.' '.$last_name?></title>
  <?php include '../css/css.html'; ?>
</head>

<body>
  <div class="form">

          <h1>Welcome</h1>


          <h2><?php echo $first_name.' '.$last_name; ?></h2>
          <p><?= $email ?></p>
          <p><?= $address.' '.$phone  ?></p>

          <a href="home.php"><button class="button button-block"/>Home</button></a><br>
          <a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>

    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../js/index.js"></script>

</body>
</html>
