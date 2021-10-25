<?php    
	$login = $_POST['login'];
	$password = $_POST['pass'];

	$password = md5($password."test123");

	$connect = pg_connect("host=localhost dbname=publishing user=www password=foo")
    or die('Не удалось соединиться: ' . pg_last_error());

	$result = pg_query($conn, "SELECT * FROM test_users WHERE login = $login AND password = $password;");

	if (!$result) 
	{
		echo "Ошибка select";
		exit();
	}

	if ($row = pg_fetch_assoc($result)) 
	{
		setcookie('testc_id', $row['id'], time()+36000, "/");
		setcookie('testc_login', $row['login'], time()+36000, "/");
		header('Location: t_index.php');
	}
	else
	{
		echo "Польз не найден";
		exit();
	}

	pg_free_result($result);
	pg_close($connect);
?>