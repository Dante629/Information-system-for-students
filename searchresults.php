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

	<title>Результаты поиска - Информационная система для студентов</title>

	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

	
    
</head>
<body>

  <?php include 'header.php'; ?>

  <section>

    <?php 

      if(isset($_GET['search'])) {

        $s = clean($_GET['searchbox']);

        $query = "SELECT studentno, firstname, lastname, course, yrlevel, DATE_FORMAT(date_joined, '%m/%d/%Y') as date_joined, CONCAT(firstname, ' ', lastname) as fullname 
        FROM students WHERE CONCAT(firstname, ' ', lastname) = '$s' OR firstname = '$s' OR lastname = '$s' ORDER BY date_joined DESC LIMIT 5";
    ?>

    <div class="container">
      <strong class="title">Результаты поиска для "<?php echo $s; ?>".</strong>


    


    <?php

        if($result = mysqli_query($con, $query)) {

          if(mysqli_num_rows($result) == 0) {

            echo "<p>Ни один результат не соответствует вашему запросу.</p>";
            echo "</div>";

          } else {
            echo "</div>";
            echo "<ul class='profile-results'>";

            while($row = mysqli_fetch_assoc($result)) {

          ?>

              <li>
                <div class="result-box box-left">
                  <div class='info'><strong>Номер студента:</strong> <span><?php echo $row['studentno']; ?></span></div>
                  <div class='info'><strong>Имя студента:</strong> <span><?php echo $row['lastname']. ", ".$row['firstname']; ?></span></div>
                  <div class='info'><strong>Факультет:</strong> <span><?php echo $row['course']; ?></span></div>
                  <div class='info'><strong>Курс:</strong> <span><?php echo $row['yrlevel']; ?></span></div>
                  <div class='info'><strong>Дата добавления в систему:</strong> <span><?php echo $row['date_joined']; ?></span></div>
                </div>
              </li>

          <?php

            }

            echo "</ul>";

          }

        } else {
          die("Error with the query");
        }

      }

    ?>
  
    <div class="container">
      <a href="profile.php">Вернуться в Мой профиль</a>
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

  mysqli_close($con);

?>