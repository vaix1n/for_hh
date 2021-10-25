<?php
	//нужна авторизация!)
	if(!isset($_COOKIE['testc_id']))
	{
		header('Location: t_auth_page.php');
		exit();
	}

	//коннект к бд
	$connect = pg_connect("host=localhost dbname=publishing user=www password=foo")
    	or die('Не удалось соединиться: ' . pg_last_error());


	//смотрим книжки
	$db_information = pg_query($connect, "SELECT * FROM test_books");
	if (!$db_information) {
	    echo "Ошибка select";
	    exit;
	}
	$db_information = pg_fetch_all($db_information);
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
	
	<title>Test books!</title>
</head>



<body>
	<table>
		<thead>
			<tr>
				<th>
					Автор
				</th>
				<th>
					Название
				</th>
				<th>
					Кто взял
				</th>
				<th>
					Когда вернет
				</th>
			</tr>
		</thead>

		<tbody>
			<?php
				foreach ($db_information as $db_inf) 
				{
				?>

					<tr>
						<td><?=$db_inf[1]?></td>
						<td><?=$db_inf[2]?></td>
						<?php
						if($db_inf[3] > 0)
						{
						?>

							<td><?=$db_inf[3]?></td>
							<td><?=$db_inf[4]?></td>
						
						<?php
						}
						else
						{
						?>

							<td>В наличии</td>
							<td>В наличии</td>
						
						<?php
						}
						?>
					</tr>

					<?php
				}
			?>
		</tbody>
	</table>
	
</body>
</html>

<?php
pg_close($connect);
?>