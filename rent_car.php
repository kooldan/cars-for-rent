<?php
	$connect = mysqli_connect("mysql.16-pn.myjino.ru","16-pn","it12345","16-pn_daniil");
	
	$query = mysqli_query($connect, "SELECT * FROM rents WHERE date = '".$_POST['date']."' AND car_id = '".$_POST['car_id']."'");
	$rows = $query->num_rows;
	if($rows != 0){
		header("Location: car.php?id=".$_POST['car_id']."&user=".$_POST['user_id']."&err=1");
	}
	else{
	mysqli_query($connect, "INSERT INTO rents (rent_id, user_id, date, car_id) VALUES (NULL,'".$_POST['user_id']."', '".$_POST['date']."', '".$_POST['car_id']."');");
	header("Location: user.php?id=".$_POST['user_id']."&user=".$_POST['user_id']."&err=1");
	}
?>