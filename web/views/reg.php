<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>cars for rent</title>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">cars for rent</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          
          <?php 
          if($query_user->num_rows == 0){?>
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Главная</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Войти</a>
          </li>
          <?php }
          else{ ?>
          <li class="nav-item active">
            <a class="nav-link" href="index.php?user=<?php echo $result_user['id']?>">Главная</a>
          </li>
          <li class="nav-item">
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $result_user["username"] ?>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
              <a class="dropdown-item" href="user.php?id=<?php echo $result_user['id']?>">Аккаунт</a>
              <a class="dropdown-item text-danger" href="car.php">Выйти</a>
            </div>
          </div>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <div class="w-50 mx-auto">
      <div class="border rounded border-dark bg-light p-5 mx-auto my-3">
      <form action="create_user.php" method="POST">
        <h2 class="mb-3">Регистрация</h2>
        <div class="form-group row">
          <label for="colFormLabel" class="col-sm-3 col-form-label">Логин: </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="login" placeholder="Введите логин...">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabel" class="col-sm-3 col-form-label">Пароль: </label>
          <div class="col-sm-9">
            <input type="password" class="form-control" name="password" placeholder="Введите пароль...">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabel" class="col-sm-3 col-form-label"></label>
          <div class="col-sm-9">
            <input type="password" class="form-control" name="passwordd" placeholder="Подтвердите пароль...">
          </div>
        </div>
        
        <button type="submit" class="btn btn-primary w-100">Подтвердить</button>
        <?php if($_GET["isgood"]==1){
          echo "<p class='text-danger mb-0 mt-2'>Пароли не совпадают</p>";
        } else if($_GET["isgood"]==2){ 
          echo "<p class='text-danger mb-0 mt-2'>Такой Аккаунт уже существует</p>";
        } ?>
      </form>
      </div>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
