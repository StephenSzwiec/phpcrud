<?php
	include 'config.php';
	$connection = create_connection();
	$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$msg = '';
	//Check for empty POST
	if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['dob']) && !empty($_POST['department']) ) {
		// post data not empty
		// insert a new record
		$id = gen_id();
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$dob = $_POST['dob'];
		$department = $_POST['department'];
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		//insert new record into table
		$stmt = $connection->prepare('INSERT INTO EMPLOYEE VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
		$stmt->execute([$id, $fname, $lname, $email, $dob, $department, $created, $updated]);
		//output message
		$msg = 'Created Successfully!';
		sleep(3);
		header('Location: read.php');
	}
?>

<?=make_header('Create')?>

<div class="update">
	<h2>Create Employee</h2>
	<form action="create.php" method="post">
	<div>
		<label for="fname">First Name</label>
		<input type="text" name="fname" id="fname">
		<label for="lname">Last Name</label>
		<input type="text" name="lname" id="lname">
		<label for="email">Email</label>
		<input type="email" name="email" id="email">
		<label for="dob">Date of Birth</label>
		<input type="date" name="dob" id="dob">
		<label for="department">Department</label>
		<select name="department">
			<option value="Executive">Executive</option>
			<option value="Engineering">Engineering</option>
			<option value="Accounting">Accounting</option>
			<option value="Logistics">Logistics</option>
			<option value="Sales">Sales</option>
			<option value="Research">Research</option>
			<option value="Marketing">Marketing</option>
			<option value="IT Systems">IT Systems</option>
		</select>
	</div>
		<input type="submit" value="Create">
		<p>&nbsp;</p>
		<input type="reset">
	</form>
	<?php if ($msg): ?>
	<p><?=$msg?></p>
	<?php endif; ?>
</div>

<?=make_footer()?>
