<?php
//Коннект
$connect = new mysqli('ip', 'root', 'pass', 'bd');

//Неудачно
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
    exit();
}

//кодировка
$connect->query("SET NAMES utf8");

//создание т для логинов
$db_information = mysqli_query($connect, "CREATE TABLE IF NOT EXISTS `test_users` (
		  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		  `login` varchar(64) NOT NULL,
		  `password` varchar(256) NOT NULL,
		  UNIQUE KEY `id` (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8");

//ошибка создания т для логинов
if(!$db_information)
{
	//не создана
	echo mysqli_error($connect);
}
else
{
	//создаем тест учетку сразу после создания бд
	$login = 'TestUser';
	$password = 'TestPass';
	$password = md5($password."test123");

	$stmt = mysqli_prepare($connect, "INSERT INTO test_users (login, password) VALUES(?, ?)");
	mysqli_stmt_bind_param($stmt, "ss", $login, $password);
	mysqli_stmt_execute($stmt);
}

// т для книг
$db_information = mysqli_query($connect, "CREATE TABLE IF NOT EXISTS `test_books` (
		  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		  `book_author` varchar(128) NOT NULL,
		  `book_name` varchar(128) NOT NULL,
		  `book_tookid` int(11) NOT NULL,
		  `book_returndate` date NOT NULL,
		  UNIQUE KEY `id` (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8");

//ошибка создания т для книг
if(!$db_information)
{
	//не создана
	echo mysqli_error($connect);
}
else
{
	//для даты
	$today = date("Y-m-d");

	//заносим книги сразу после создания бд
	$book_author = 'Test Author 1';
	$book_name = 'Testing 1 name in bd';
	$book_tookid = '1';
	$book_returndate = '2021-10-30';

	$stmt = mysqli_prepare($connect, "INSERT INTO test_books (book_author, book_name, book_tookid, book_returndate) VALUES(?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "ssis", $book_author, $book_name, $book_tookid, $book_returndate);
	mysqli_stmt_execute($stmt);

	$book_author = 'Test Author 2';
	$book_name = 'Testing 2 name in bd';
	$book_tookid = '0';
	$book_returndate = $today;
	mysqli_stmt_execute($stmt);

	$book_author = 'Test Author 3';
	$book_name = 'Testing 3 name in bd';
	$book_tookid = '0';
	$book_returndate = $today;
	mysqli_stmt_execute($stmt);

	$book_author = 'Test Author 4';
	$book_name = 'Testing 4 name in bd';
	$book_tookid = '1';
	$book_returndate = '2021-10-31';
	mysqli_stmt_execute($stmt);


	header('Location: t_auth_page.php');
}

//закрыть соед
mysqli_close($connect);

//header('Location: /t_auth_page.php');
?>

