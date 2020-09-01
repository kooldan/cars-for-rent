<?php
	$connect = mysqli_connect("mysql.16-pn.myjino.ru","16-pn","it12345","16-pn_daniil");
	if($_POST['password']!=$_POST['passwordd']){
		header("Location: reg.php?isgood=1");
	}
	else{
	$query = mysqli_query($connect, "SELECT * FROM users WHERE username = '".$_POST['login']."' AND password = '".$_POST['password']."'");
	$rows = $query->num_rows;
	if($rows != 0){
		header("Location: reg.php?isgood=2");
	}
	else{
	mysqli_query($connect, "INSERT INTO users (username, password) VALUES ('".$_POST['login']."', '".$_POST['password']."')");
	header("Location: login.php?good=1");
	}
	}
?>