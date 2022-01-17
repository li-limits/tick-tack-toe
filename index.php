<?php
session_start();
include "backend/dbconnect.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="frontend/css/style1.css">
	<link rel="stylesheet" type="text/css" href="frontend/css/styles2.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<script
       src="https://code.jquery.com/jquery-3.6.0.min.js"
       integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
       crossorigin="anonymous"></script>
	
</head>
<body>
	
	<div class="wrapper">
		<div class="game">
			<div class="top">
				<div class="top_wrapper">
					<h1><a href="index.php"><span>Main page</span></a></h1>
					<?php if ($_SESSION['user_id']) { echo("<h1><a href='#' class='create_room'>Create room</a></h1>");
					 	include 'frontend/html/create_room.html';
					 	echo("<div class='overlay'></div>");} ?>
				</div>
			</div>

			<div class="main_body" style="height: 1000px;">
				<div class="main_body_wrapper" style="height: 1000px;">
					<div class="main_body_left">
						<div class="main_body_left_wrapper">
							
							<div class="top_main">All rooms</div>
							
							<div class="main_main">

							</div>

						</div>
					</div>

					<div class="main_body_right">
						<div class="main_body_right_wrapper">
							<div class="top_main"></div>
							<div class="user_data">
								<div class="user_data_wrapper">
									<div class="text_data">
										<?php 
										    
										    


											if ($_SESSION['user_id']){
    											
    											$x = 100;
    										    $sql = "SELECT * FROM `users` WHERE user_id = :user_id";
                                                $result = $conn->prepare($sql);
                                                $result->execute(array(':user_id' => $_SESSION['user_id']));
                                                $row = $result->fetch();
    											echo("<div>Login:</div></br><div style='color: limegreen;'>".$row['login']."</div></br>");
											
											}else{
												
												echo("<p><a href='#' class='create_acc'>Create acc</a></p>");
												include 'frontend/html/newacc_window.html';
												echo("<p><a href='#' class='login'>Login</a></p>");
												include 'frontend/html/login_window.html';
												echo("<div class='overlay'></div>");
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script src="frontend/js/javascript.js"></script>
</body>
</html>