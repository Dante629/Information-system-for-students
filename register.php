<?php 

  session_start();

  require 'connect.php';
  require 'functions.php';


  if(isset($_POST['register'])) {

    $uname = clean($_POST['username']); 
    $pword = clean($_POST['password']); 
    $studno = clean($_POST['studentno']); 
    $fname = clean($_POST['firstname']); 
    $lname = clean($_POST['lastname']); 
    $course = clean($_POST['course']); 
    $yrlevel = clean($_POST['yrlevel']); 

    $query = "SELECT username FROM students WHERE username = '$uname'";
    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result) == 0) {

      $query = "SELECT studentno FROM students WHERE studentno = '$studno'";
      $result = mysqli_query($con,$query);

      if(mysqli_num_rows($result) == 0) {

        $query = "INSERT INTO students (username, password, studentno, firstname, lastname, course, yrlevel, date_joined)
        VALUES ('$uname', '$pword', '$studno', '$fname', '$lname', '$course', '$yrlevel', NOW())";

        if(mysqli_query($con, $query)) {

          $_SESSION['prompt'] = "Account registered. You can now log in.";
          header("location:index.php");
          exit;

        } else {

          die("Error with the query");

        }

      } else {

        $_SESSION['errprompt'] = "That student number already exists.";

      }

    } else {

      $_SESSION['errprompt'] = "Username already exists.";

    }

  } 

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Регистрация - Информационная система для студентов</title>

	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

	
</head>
<body>

  <?php include 'header.php'; ?>

  <section class="center-text">
    
    <strong>Регистрация</strong>

    <div class="registration-form box-center clearfix">

    <?php 
        if(isset($_SESSION['errprompt'])) {
          showError();
        }
    ?>

      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        
        <div class="row">
          <div class="account-info col-sm-6">
          
            <fieldset>
              <legend>Информация об учетной записи</legend>
              
              <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input type="text" class="form-control" name="username" placeholder="Имя пользователя " required>
              </div>

              <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" name="password" placeholder="Пароль" required>
              </div>

            </fieldset>
            

          </div>

          <div class="personal-info col-sm-6">
            
            <fieldset>
              <legend>Персональная информация</legend>
              
              <div class="form-group">
                <label for="studentno">Номер студента</label>
                <input type="text" class="form-control" name="studentno" placeholder="Номер студента" required>
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

            </fieldset>
            

          </div>
        </div>

        
        
        <a href="index.php">Вернуться назад</a>
        <input class="btn btn-primary" type="submit" name="register" value="Зарегистрироваться">



      </form>
    </div>

  </section>


	<script src="assets/js/jquery-3.1.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>

<?php 

  unset($_SESSION['errprompt']);
  mysqli_close($con);

?>