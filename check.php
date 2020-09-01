<?php
	$connect = mysqli_connect("mysql.16-pn.myjino.ru","16-pn","it12345","16-pn_daniil");
	$query = mysqli_query($connect, "SELECT * FROM users WHERE username = '".$_POST['login']."' AND password = '".$_POST['password']."'");
	$rows = $query->num_rows;
	$result = $query->fetch_assoc();
	if($rows == 0){
		header("Location: login.php?isgood=1");
	}
	else{
		header("Location: index.php?user=".$result["id"]);
	}
?>