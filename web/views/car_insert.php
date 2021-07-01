<?php
	include_once('functions.php');
	$connect = mysqli_connect("mysql.16-pn.myjino.ru","16-pn","it12345","16-pn_daniil");
	$query = mysqli_query($connect, "SELECT * FROM cars WHERE car_number = '".$_POST['number']."'");
	$rows = $query->num_rows;
	if($rows != 0){
		header("Location: create_car.php?id=".$_POST["user"]."&user=".$_POST["user"]."&isgood=2");
	}
	else{
	echo $_FILES['file']['name'];
    if(isset($_FILES['file'])) {
      // проверяем, можно ли загружать изображение
      $check = can_upload($_FILES['file']);
      if($check === true){
        // загружаем изображение на сервер
        $name = mt_rand(0, 10000) . $_FILES['file']['name'];
        echo $name;
        make_upload($_FILES['file'], $name);
        mysqli_query($connect, "INSERT INTO cars ('id', 'owner_id', 'name', 'car_number', 'description', 'cost', 'img') VALUES (NULL, '".$_POST["user"]."', '".$_POST["name"]."', '".$_POST["number"]."', '".$_POST["desc"]."', '".$_POST["cost"]."','".$name."');");
		
      }
      else{
        // выводим сообщение об ошибке
        header("Location: create_car.php?id=".$_POST["user"]."&user=".$_POST["user"]."&nogood=".$check);
      }
    }
	}
?>