<?php 

  session_start();

  require 'connect.php';
  require 'functions.php';

  if(isset($_SESSION['username'], $_SESSION['password'])) {

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Профиль - Информационная система для студентов</title>

  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/main.css" rel="stylesheet">

	
</head>
<body>

  <?php include 'header.php'; ?>

  <section>

    <div class="container">
      <strong class="title">Мой профиль</strong>
    </div>
    
    
    <div class="profile-box box-left">

      <?php

        if(isset($_SESSION['prompt'])) {
          showPrompt();
        }


        $query = "SELECT * FROM students WHERE username = '".$_SESSION['username']."' AND password = '".$_SESSION['password']."'";

        ;

        if($result = mysqli_query($con, $query)) {

          $row = mysqli_fetch_assoc($result);

          echo "<div class='info'><strong>Номер студента:</strong> <span>".$row['studentno']."</span></div>";
          echo "<div class='info'><strong>Имя студента:</strong> <span>".$row['lastname'].", ".$row['firstname']."</span></div>";
          echo "<div class='info'><strong>Факультет:</strong> <span>".$row['course']."</span></div>";
          echo "<div class='info'><strong>Курс:</strong> <span>".$row['yrlevel']."</span></div>";

          $query_date = "SELECT DATE_FORMAT(date_joined, '%m/%d/%Y') FROM students WHERE id = '".$_SESSION['userid']."'";
          $result = mysqli_query($con, $query_date);

          $row = mysqli_fetch_row($result);

          echo "<div class='info'><strong>Дата добавления в систему:</strong> <span>".$row[0]."</span></div>";

        } else {

          die("Ошибка запроса к базе данных");

        }

      ?>
      
      <div class="options">
        <a class="btn btn-primary" href="editprofile.php">Редактировать профиль</a>
        <a class="btn btn-success" href="changepassword.php">Сменить пароль</a>
      </div>

      
    </div>

  </section>


	<script src="assets/js/jquery-3.1.1.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>

<?php


  } else {
    header("location:index.php");
    exit;
  }

  unset($_SESSION['prompt']);
  mysqli_close($con);

?>