<?php 

  session_start();

  require 'connect.php';
  require 'functions.php';

  if(isset($_POST['update'])) {

    $oldpass = clean($_POST['oldpass']);
    $newpass = clean($_POST['newpass']);
    $confirmpass = clean($_POST['confirmpass']);

    $query = "SELECT password FROM students WHERE password = '$oldpass'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {

      if($newpass == $confirmpass) {

        $query = "UPDATE students SET password = '$newpass' WHERE id='".$_SESSION['userid']."'";

        if($result = mysqli_query($con, $query)) {

          $_SESSION['prompt'] = "Пароль обновлен.";
          $_SESSION['password'] = $newpass;
          header("location:profile.php");
          exit;

        } else {

          die("Ошибка запроса");

        }

      } else {

        $_SESSION['errprompt'] = "Введенный вами новый пароль не подходит.";;

      }

    } else {

      $_SESSION['errprompt'] = "Вы ввели неправильный старый пароль.";

    }

  }

  if(isset($_SESSION['username'], $_SESSION['password'])) {

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Сменить  пароль - Информационная система для студентов</title>

	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

	
</head>
<body>

  <?php include 'header.php'; ?>

  <section>
    
    <div class="container">
      <strong class="title">Сменить  пароль</strong>
    </div>
    

    <div class="edit-form box-left clearfix">

      <?php 
        if(isset($_SESSION['errprompt'])) {
          showError();
        }
      ?>

      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">


        <div class="form-group">
          <label for="oldpass">Старый Пароль</label>
          <input type="password" class="form-control" name="oldpass" placeholder="Старый Пароль" required>
        </div>


        <div class="form-group">
          <label for="newpass">Новый Пароль</label>
          <input type="password" class="form-control" name="newpass" placeholder="Новый Пароль" required>
        </div>

        <div class="form-group">
          <label for="confirmpass">Подтвердите Пароль</label>
          <input type="password" class="form-control" name="confirmpass" placeholder="Подтвердите Пароль" required>
        </div>

        <div class="form-footer">
          <a href="profile.php">Вернуться назад</a>
          <input class="btn btn-primary" type="submit" name="update" value="Обновить Пароль">
        </div>
        

      </form>
    </div>

  </section>


	<script src="assets/js/jquery-3.1.1.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>

<?php

  } else {
    header("location:profile.php");
  }

  unset($_SESSION['errprompt']);
  mysqli_close($con);

?>