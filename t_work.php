<?php
//Коннект
$connect = pg_connect("host=localhost dbname=publishing user=www password=foo")
    or die('Не удалось соединиться: ' . pg_last_error());


//создание т для логинов
$db_information = pg_query($connect, "CREATE TABLE `test_users` (
	  `id` bigserial primary key,
	  `login` varchar(64) NOT NULL,
	  `password` varchar(64) NOT NULL
	) ") or die('Ошибка запроса: ' . pg_last_error());


//создаем тест учетку сразу после создания бд
$login = 'TestUser';
$password = 'TestPass';
$password = md5($password."test123");

$result = pg_query($connect, "INSERT INTO test_users (login, password) VALUES($login, $password)");
pg_free_result($result);


// т для книг
$db_information = pg_query($connect, "CREATE TABLE `test_books` (
	  `id` bigserial primary key,
	  `book_author` varchar(128) NOT NULL,
	  `book_name` varchar(128) NOT NULL,
	  `book_tookid` integer NOT NULL,
	  `book_returndate` date default NULL
	) ") or die('Ошибка запроса: ' . pg_last_error());


//для даты
$today = date("Y-m-d");

//заносим книги сразу после создания бд
$book_author = 'Test Author 1';
$book_name = 'Testing 1 name in bd';
$book_tookid = '1';
$book_returndate = '2021-10-30';

$result = pg_query($connect, "INSERT INTO test_books (book_author, book_name, book_tookid, book_returndate) VALUES('$book_author', '$book_name', '$book_tookid', '$book_returndate')");
pg_free_result($result);


$book_author = 'Test Author 2';
$book_name = 'Testing 2 name in bd';
$book_tookid = '0';
$book_returndate = $today;

$result = pg_query($connect, "INSERT INTO test_books (book_author, book_name, book_tookid, book_returndate) VALUES('$book_author', '$book_name', '$book_tookid', '$book_returndate')");
pg_free_result($result);

$book_author = 'Test Author 3';
$book_name = 'Testing 3 name in bd';
$book_tookid = '0';
$book_returndate = $today;

$result = pg_query($connect, "INSERT INTO test_books (book_author, book_name, book_tookid, book_returndate) VALUES('$book_author', '$book_name', '$book_tookid', '$book_returndate')");
pg_free_result($result);

$book_author = 'Test Author 4';
$book_name = 'Testing 4 name in bd';
$book_tookid = '1';
$book_returndate = '2021-10-31';

$result = pg_query($connect, "INSERT INTO test_books (book_author, book_name, book_tookid, book_returndate) VALUES('$book_author', '$book_name', '$book_tookid', '$book_returndate')");
pg_free_result($result);


header('Location: t_auth_page.php');


//закрыть соед
pg_close($connect);
?>

