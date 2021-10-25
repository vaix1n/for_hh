<?php    
	$login = $_POST['login'];
	$password = $_POST['pass'];

	$password = md5($password."test123");

	$mysql = new mysqli('ip', 'root', 'pass', 'bd');

	if (mysqli_connect_errno()) 
	{
	    printf("%s\n", mysqli_connect_error());
	    exit();
	}

	if($stmt = $mysql->prepare('SELECT * FROM test_users WHERE login = ? AND password = ?;'))
	{
		$stmt->bind_param('ss', $login, $password);
		$stmt->execute();

		$result = $stmt->get_result();
		if ($row = $result->fetch_assoc()) 
		{
			setcookie('testc_id', $row['id'], time()+36000, "/");
			setcookie('testc_login', $row['login'], time()+36000, "/");
		}
		else
		{
			echo "Польз не найден";
			exit();
		}
		header('Location: t_index.php');
	}
	else
	{
		echo 'error prepare';
	}

	$mysql->close();
?>
