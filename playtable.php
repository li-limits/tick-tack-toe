<?php
session_start();
include 'backend/dbconnect.php';
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
				</div>
			</div>

			<div class="main_body" style="height: 1000px;">
				<div class="main_body_wrapper" style="height: 1000px;">
					<div class="main_body_left">
						<div class="main_body_left_wrapper">
							
							<div class='playboard'>
						        <div class='cells_front'></div>
						        
						        <?php $j = 1;
						        for ($i = 1; $i <= 3; $i++) {
						            echo("<div class='cells_line'>");
						                echo("<div class='cell' id='cell_$j'></div>
						                    <div class='cell_front', id='cell_front-$j' style='top: ".(($i - 1) * 200)."px; left: 0px'></div>");
						                echo("<div class='cell' id='cell_".($j+1)."'></div>
						                    <div class='cell_front', id='cell_front-".($j+1)."' style='top: ".(($i - 1) * 200)."px; left: 200px'></div>");
						                echo("<div class='cell' id='cell_".($j+2)."'></div>
						                    <div class='cell_front', id='cell_front-".($j+2)."' style='top: ".(($i - 1) * 200)."px; left: 400px'></div>");
						            echo("</div>");
						            $j = $j + 3;
						        } ?>
						    </div>
						    <div class='button_restart'>Restart!</div>
						</div>
					</div>

					<div class="main_body_right">
						<div class="main_body_right_wrapper">
							<div class="top_main"></div>
							<div class="user_data">
								<div class="user_data_wrapper">
									<div class="text_data">
										<b id='player_turn'></b>
										<a id='enemy_info' style='margin-top: 30px;'>Ваш оппонент: ---</a>
										<a id='creator_wins' style='margin-top: 30px;'></a>
										<a id='player_wins' style='margin-top: 30px;'></a>
										<b id='enemy_wait' style='margin-top: 30px; font-size: 36px'></b>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="frontend/js/playboard_script.js"></script>
	<script src="frontend/js/javascript.js"></script>
</body>
</html>