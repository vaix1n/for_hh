<?php
	if(isset($_COOKIE['testc_id'])){
		header('Location: t_index.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Exo+2&family=Open+Sans&display=swap" rel="stylesheet">

	<title>Авторизация - test</title>
</head>

<body>
	<section>
		<h2>Авторизация</h2> <br>
		<form action="t_auth.php" method="post">
			<h3>Логин</h3>
			<input type="text" name="login" placeholder="Введите логин"> <br>
			<h3>Пароль</h3>
			<input type="password" name="pass" placeholder="Введите пароль"> <br>
			<button  type="submit">Авторизация</button>
		</form>
	</section>
</body>
</html>