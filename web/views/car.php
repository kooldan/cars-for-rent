<?php
  $connect = mysqli_connect("mysql.16-pn.myjino.ru","16-pn","it12345","16-pn_daniil");
  $query = mysqli_query($connect, "SELECT * FROM cars INNER JOIN users ON cars.owner_id = users.id WHERE cars.id = '".$_GET['id']."'");
  $result_car = $query->fetch_assoc();
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
              <a class="dropdown-item" href="user.php?id=<?php echo $result_user['id']."&user=".$result_user['id'];?>">Аккаунт</a>
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

    <div class="row">
      <div class="border rounded border-dark bg-light p-5 mx-auto my-3 w-100">
        <div class="row mx-auto">
          <h2><?php echo $result_car['name']?></h2>
          <h2 class="ml-auto">Владелец - <a href="user.php?id=<?php echo $result_car['owner_id']; if($query_user->num_rows != 0){ echo "&user=".$result_user['id']; }?>"><?php echo $result_car['username']?></a></h2>
        </div>
        <div class="row mx-auto my-4">
          <div class="col-3 bg-white h-auto py-3">
            <h4 class="mb-3"><?php echo $result_car['cost']?>руб./сутки</h4>
            <?php if($query_user->num_rows != 0){?>
            <form action="rent_car.php" method="POST">
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 col-form-label">День: </label>
                <div class="col-sm-9 pt-1">
                  <input type="date" name="date">
                </div>
              </div>
              <input type="hidden" name="user_id" value="<?php echo $_GET['user'] ?>">
              <input type="hidden" name="car_id" value="<?php echo $_GET['id'] ?>">
              <button class="btn btn-primary" type="submit">Арендовать</button>
              <?php if($_GET['err']==1){?>
              <p class="text-danger">Машина на данный день уже забронирована</p>
              <?php } ?>
            </form>
            <?php } ?>
          </div>
          <img class="col-9 pr-0" src="img/<?php echo $result_car['img']?>" alt="">
        </div>
        <h3 class="text-justify"><?php echo $result_car['description']?></h3>
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
