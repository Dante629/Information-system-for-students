<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">

    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Навигация</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

      <a class="navbar-brand" href="index.php">Информационная система для студентов</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

    <?php 

      if(isset($_SESSION['username'], $_SESSION['password'])) {

    ?>

      <form class="navbar-form navbar-right" action="searchresults.php" method="GET">

        <div class="search-area">
          <div class="form-group">

            <div class="search-wrap">

              <label for="searchbox" class="sr-only">Поиск:</label>
              <input type="text" class="form-control" name="searchbox" id="searchbox" placeholder="Поиск студента по имени" required autocomplete="off">
              
              <div class="search-results hide"></div>

            </div>
            

          </div>
          <input type="submit" name="search" id="search-btn" value="Поиск" class="btn btn-default">

        </div>
        
        <div class="welcome"><?php echo "Добро пожаловать, <a href='profile.php'>".$_SESSION['username']."</a>!";?></div>

        <a href="logout.php">Выйти из системы<span class="glyphicon glyphicon-off" aria-hidden="true"></span></a>

      </form>

      <?php 

        } else {
          echo "<span class='not-logged'>Вы не вошли в систему.</span>";
        }

      ?>

      


    </div>
  </div>
</nav>
