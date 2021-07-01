<?php
  $connect = mysqli_connect("mysql.16-pn.myjino.ru","16-pn","it12345","16-pn_daniil");
  $query_user = mysqli_query($connect, "SELECT * FROM users WHERE id = '".$_GET['user']."'");
  $result_user = $query_user->fetch_assoc();
?>
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
              <a class="dropdown-item text-danger" href="index.php">Выйти</a>
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
    <div class="w-80 mx-auto">
      <div class="border rounded border-dark bg-light p-5 mx-auto my-3">
      <form enctype="multipart/form-data" action="car_insert.php" method="POST">
        <h2 class="mb-4 mt-n2">Начать сдавать машину в аренду</h2>
        <div class="form-group row">
          <label for="colFormLabel" class="col-sm-3 col-form-label">Название: </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="name" placeholder="Название">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabel" class="col-sm-3 col-form-label">Номер машины: </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="number" placeholder="Номер машины">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabel" class="col-sm-3 col-form-label">Посуточная аренда(руб.): </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="cost" placeholder="Посуточная аренда">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabel" class="col-sm-3 col-form-label">Описание: </label>
          <div class="col-sm-9">
            <textarea type="text" name="desc" class="form-control" placeholder="Описание"></textarea>
          </div>
        </div>
        
        <input type="file" class="custom-file-input" aria-describedby="inputGroupFileAddon01" name="file">
        

        <input type="hidden" name="user" value="<?php echo $result_user['id'] ?>">
        <button type="submit" class="btn btn-primary w-100">Подтвердить</button>
        <?php if($_GET["isgood"]==2){
        echo "<p class='text-danger mb-0 mt-2'>Машина с таким номером уже существует</p>";
      }?>
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
