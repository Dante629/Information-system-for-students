<?php 

  session_start();

  require 'connect.php';
  require 'functions.php';

  if(isset($_POST['update'])) {

    $fname = clean($_POST['firstname']);
    $lname = clean($_POST['lastname']);
    $course = clean($_POST['course']);
    $yrlevel = clean($_POST['yrlevel']);

    $query = "UPDATE students SET firstname = '$fname', lastname = '$lname', course = '$course', yrlevel = '$yrlevel'
    WHERE id='".$_SESSION['userid']."'";

    if($result = mysqli_query($con, $query)) {

      $_SESSION['prompt'] = "Профиль Обновлен";
      header("location:profile.php");
      exit;

    } else {

      die("Error with the query");

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

	<title>Редактирование профиля - Информационная система для студентов</title>

	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

	
</head>
<body>

  <?php include 'header.php'; ?>

  <section>
    
    <div class="container">
      <strong class="title">Редактировать профиль</strong>
    </div>
    

    <div class="edit-form box-left clearfix">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

        <div class="form-group">
          <label>Номер студента:</label>
          
          <?php 
            $query = "SELECT studentno FROM students WHERE id = '".$_SESSION['userid']."'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_row($result);

            echo "<p>".$row[0]."</p>";
          ?>

        </div>


        <div class="form-group">
          <label for="firstname">Имя</label>
          <input type="text" class="form-control" name="firstname" placeholder="Имя" required>
        </div>


        <div class="form-group">
          <label for="lastname">Фамилия</label>
          <input type="text" class="form-control" name="lastname" placeholder="Фамилия" required>
        </div>


        <div class="form-group">
          <label for="course">Факультет</label>

          <select class="form-control" name="course">
              <option value="ЭДМ">ЭДМ</option>
              <option value="МИФП">МИФП</option>
              <option value="ПВФ">ПВФ</option>
              <option value="ИВС">ИВС</option>
              <option value="ПФФ">ПФФ</option>
              
            </select>

        </div>


        <div class="form-group">
          <label for="yrlevel">Выберите курс</label>

          <select class="form-control" name="yrlevel">
              <option>1 Курс</option>
              <option>2 Курс</option>
              <option>3 Курс</option>
              <option>4 Курс</option>
          </select>

        </div>
        
        <div class="form-footer">
          <a href="profile.php">Вернуться назад</a>
          <input class="btn btn-primary" type="submit" name="update" value="Обновить профиль">
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

  mysqli_close($con);

?>