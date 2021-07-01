<?php
  $connect = mysqli_connect("mysql.16-pn.myjino.ru","16-pn","it12345","16-pn_daniil");
  $query_user = mysqli_query($connect, "SELECT * FROM users WHERE id = '".$_GET['id']."'");
  $result_user = $query_user->fetch_assoc();
  $query_rent = mysqli_query($connect, "SELECT * FROM rents INNER JOIN cars ON rents.car_id = cars.id WHERE rents.user_id = '".$_GET['id']."'");
  $query_you = mysqli_query($connect, "SELECT * FROM users WHERE id = '".$_GET['user']."'");
  $result_you = $query_you->fetch_assoc();
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

<body class="bg-light">

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
          if($query_you->num_rows == 0){?>
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Главная</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Войти</a>
          </li>
          <?php }
          else{ ?>
          <li class="nav-item active">
            <a class="nav-link" href="index.php?user=<?php echo $result_you['id']?>">Главная</a>
          </li>
          <li class="nav-item">
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $result_you["username"] ?>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
              <a class="dropdown-item" href="user.php?id=<?php echo $result_you['id']."&user=".$result_you['id'];?>">Аккаунт</a>
              <a class="dropdown-item text-danger" href="user.php?id=<?php echo $_GET['id']?>">Выйти</a>
            </div>
          </div>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container bg-light">

    <div class="row my-4">
      <div class="col-lg-3 border border-light bg-white">
        <div class="border-bottom border-light p-3">
          <div class="row mx-auto">
            <h2><?php echo $result_user['username']?></h2>
          </div>
          <?php if($_GET['err']==1){?>
            <p class="text-success">Машина успешно забронирована</p>
          <?php } else if($_GET['err']==2){?>
            <p class="text-success">Аренда успешно удалена</p>
          <?php } else if($_GET['err']==3){?>
            <p class="text-success">Машина успешно добавлена</p>
          <?php } else {?>
            <p class="text-danger"><?php echo $_GET['nogood']?></p>
          <?php }?>
          <div class="row mx-auto">
            <a href="create_car.php?user=1" class="btn btn-primary my-1">Сдать машину в аренду</a>
          </div>
        </div>
        <div data-spy="scroll" class="border-bottom border-light p-3">
        <h2>Аренды</h2>
        <?php
          for ($i=0; $i < $query_rent->num_rows; $i++) { 
            $result_rent = $query_rent->fetch_assoc(); ?>
            <h4 class="my-3 border border-dark p-2"><?php echo $result_rent["name"] ?> на <?php echo str_ireplace('-', '.', $result_rent["date"]) ?><br>
              <form action="delete_rent.php" class="mt-1" method="POST">
                <input type="hidden" name="you" value="<?php echo $_GET["user"] ?>">
                <input type="hidden" name="user" value="<?php echo $_GET["id"] ?>">
                <input type="hidden" name="rent_id" value="<?php echo $result_rent["rent_id"] ?>">
                <button type="submit" class="btn btn-danger">Удалить</button>
              </form>
            </h4>
        <?php } ?>
        </div>
      </div>
      <div class="col-lg-9 border border-light bg-white p-4">
        <h2>Машины</h2>
        <div class="row">
          <?php
            $query_own = mysqli_query($connect, "SELECT * FROM cars WHERE owner_id = ". $_GET['id']);
            for ($i=0; $i < $query_own->num_rows; $i++) { 
              $result_car = $query_own->fetch_assoc(); ?>
              <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                  <a href="car.php?id=<?php echo $result_car['id']; if($query_you->num_rows != 0){ echo "&user=".$result_you['id']; }?>"><img class="card-img-top" src="img/<?php echo $result_car['img'] ?>" alt=""></a>
                  <div class="card-body">
                    <h4 class="card-title">
                      <a href="car.php?id=<?php echo $result_car['id']; if($query_you->num_rows != 0){ echo "&user=".$result_you['id']; }?>"><?php echo $result_car['name']?></a>
                    </h4>
                    <h5><?php echo $result_car['cost']?> руб./сутки</h5>
                    <a href="change_car.php?sell=<?php echo $result_user['id']?>&car=<?php echo $result_car['id']; if($query_you->num_rows != 0){ echo "&user=".$result_you['id']; }?>" class="btn btn-primary">Изменить</a>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted"><?php echo $result_car['name']?></small>
                  </div>
                </div>
              </div>
          <?php } ?>
        </div>
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
