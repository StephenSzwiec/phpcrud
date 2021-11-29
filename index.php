<?php
	include 'config.php';
?>

<?=make_header('Home')?>
<div>
	<h2>Home</h2>
	<p>Welcome to the CRUD app.</p>
	<p>This web application uses PHP's PDO library to create a connection to MariaDB and manipulates an Employee table with Creation, Reading, Updating, and Deletion (CRUD) of database objects. Pages are built dynamically using PHP as a middleware language, and Nginx provides the basic webserver, and all of these are running on Arch Linux (together, a LEMP stack.)</p>
</div>

<?=make_footer()?>
