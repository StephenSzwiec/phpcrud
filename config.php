<?php
	function create_connection() {
		$HOST = 'localhost';
		$USER = 'phpcrud';
		$PASS = '#SomeLongerPassword420';
		$DB = 'Assignment10';
		try {
			return new PDO('mysql:host=' . $HOST . ';dbname=' . $DB . ';charset=utf8', $USER, $PASS);
		} catch (PDOException $exception) {
    			exit($exception);
    		}
	}

	function make_header($title) {
		echo<<<EOT
			<!DOCTYPE html>
			<html lang="en">
				<head>
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<link href="style.css" rel="stylesheet" type="text/css">
					<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
					<link rel="icon" type="image/png" href="data:image/png;base64,">
					<title>$title</title>
				</head>
				<body>
					<nav class="topbar">
						<div>
							<h1>Assignment 10 - PHP CRUD </h1>
							<p> </p>
							<a href="index.php"><i class="fas fa-home"></i>Home</a>
							<a href="read.php"><i class="fas fa-address-book"></i>Employees</a>
						</div>
					</nav>
		EOT;
	}

	function make_footer() {
		echo<<<EOT
			</body>
			</html>
		EOT;
	}

	function gen_id() {
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$input_len = strlen($permitted_chars);
		$random_string = '';
		for($i = 0; $i < 6; $i++) {
			$random_character = $permitted_chars[mt_rand(0, $input_len - 1)];
			$random_string .= $random_character;
		}
		return $random_string;
	}
?>
