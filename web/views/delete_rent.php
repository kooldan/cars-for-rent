<?php
	$connect = mysqli_connect("mysql.16-pn.myjino.ru","16-pn","it12345","16-pn_daniil");
	mysqli_query($connect, "DELETE FROM rents WHERE rent_id = ".$_POST['rent_id']);
	header("Location: user.php?id=".$_POST['user']."&user=".$_POST['you']."&err=2");
?>