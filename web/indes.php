<?php
  $connect = mysqli_connect("mysql.16-pn.myjino.ru","16-pn","it12345","16-pn_daniil");
  $query_cars = mysqli_query($connect, "SELECT * FROM cars");
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
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">cars for rent</h1>
        <div class="list-group">
          <a href="#" class="list-group-item">Легковые машины</a>
          <a href="#" class="list-group-item">Многоместные машины</a>
          <a href="#" class="list-group-item">Грузовые машины</a>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
        
        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="img/jojo1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="img/jojo2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="img/jojo3.jpg" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        
        <div class="row my-4">
          <?php
            $query_own = mysqli_query($connect, "SELECT * FROM users INNER JOIN cars ON users.id = cars.owner_id");
            for ($i=0; $i < $query_cars->num_rows; $i++) { 
              $result_car = $query_cars->fetch_assoc(); 
              $result_own = $query_own->fetch_assoc();?>
              <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                  <a href="car.php?id=<?php echo $result_car['id']; if($query_user->num_rows != 0){ echo "&user=".$result_user['id']; }?>"><img class="card-img-top" src="img/<?php echo $result_car['img'] ?>" alt=""></a>
                  <div class="card-body">
                    <h4 class="card-title">
                      <a href="car.php?id=<?php echo $result_car['id']; if($query_user->num_rows != 0){ echo "&user=".$result_user['id']; }?>"><?php echo $result_car['name']?></a>
                    </h4>
                    <h5><?php echo $result_car['cost']?> руб./сутки</h5>
                    <p class="card-text">Номер машины - <?php echo $result_car['car_number']?></p>
                    <p class="card-text">Владелец машины - <a href="user.php?id=<?php echo $result_own['id']; if($query_user->num_rows != 0){ echo "&user=".$result_user['id']; }?>"><?php echo $result_own['username']?></a></p>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted"><?php echo $result_car['name']?></small>
                  </div>
                </div>
              </div>
          <?php } ?>
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

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
