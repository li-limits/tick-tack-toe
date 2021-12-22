<?php
session_start();
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/css.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<script
       src="https://code.jquery.com/jquery-3.6.0.min.js"
       integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
       crossorigin="anonymous"></script>
	
</head>
<body>
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
    <script src="../js/playboard_script.js"></script>
</body>
</html>