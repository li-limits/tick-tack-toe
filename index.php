<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="frontend/css/css.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<script
       src="https://code.jquery.com/jquery-3.6.0.min.js"
       integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
       crossorigin="anonymous"></script>
	
</head>
<body>
	<?php if ($_SESSION['user_id']){
		echo("123");
	}
	?>
	<a href='#' class='create_room'>Create room</a>
	<?php include 'frontend/html/create_room.html'; ?>
	<p><a href='#' class='create_acc'>Create acc</a></p>
	<?php include 'frontend/html/newacc_window.html'; ?>
	<p><a href='#' class='login'>Login</a></p>
	<?php include 'frontend/html/login_window.html'; ?>
	<div class='overlay'></div>
	<div class='rooms_display'>
		<div class='columns'>
			<b>Название комнаты</b>
			<b>Создатель</b>
			<b>Пароль</b>
		</div>
		<?php
			include 'backend/rooms_draw.php';
		?>
	</div>
	<script src="frontend/js/javascript.js"></script>
</body>
</html>