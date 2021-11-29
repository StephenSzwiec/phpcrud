<?php
	include 'config.php';
	$connection = create_connection();
	$msg = '';
	// Check if the ID exists
	if (isset($_GET['id'])) {
		$stmt = $connection->prepare('SELECT * FROM EMPLOYEE WHERE Empl_ID = ?');
		$stmt->execute([$_GET['id']]);
		$employee = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!$employee) {
			exit('Employee does not exist with that ID.');
			sleep(3);
			header('Location: read.php');
		}
		// Check if post body is empty
		if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['dob']) && !empty($_POST['department']) ) {
			// post data not empty
			// update record
			$id = $employee['Empl_ID'];
			$fname = isset($_POST['fname']) ? $_POST['fname'] : $employee['EmplFirstName'];
			$lname = isset($_POST['lname']) ? $_POST['lname'] : $employee['EmplLastName'];
			$email = isset($_POST['email']) ? $_POST['email'] : $employee['EmplEmail'];
			$dob = isset($_POST['dob']) ? $_POST['dob'] : $employee['EmplDateofBirth'];
			$department = isset($_POST['department']) ? $_POST['department'] : $employee['EmplDepartment'];
;
			$created = $employee['CreatedAt'];
			$updated = date('Y-m-d H:i:s');
			//insert new record into table
			$stmt = $connection->prepare('UPDATE EMPLOYEE SET Empl_ID= ?, EmplFirstName= ?, EmplLastName= ?, EmplEmail= ?, EmplDateofBirth= ?, EmplDepartment= ?, CreatedAt= ?, UpdatedAt= ? WHERE Empl_ID = ?');
			$stmt->execute([$id, $fname, $lname, $email, $dob, $department, $created, $updated, $id]);
			//output message
			$msg = 'Updated Successfully!';
			sleep(3);
			header('Location: read.php');
		}
	} else {
		exit('No ID specified');
		sleep(3);
		header('Location: read.php');
	}
?>

<?=make_header('Update')?>

<div class="update">
	<h2>Employee Update</h2>
	<form action="update.php?id=<?=$employee['Empl_ID']?>" method="post">
	<div>
		<label for="fname">First Name</label>
		<input type="text" name="fname" value="<?=$employee['EmplFirstName']?>" id="fname">
		<label for="lname">Last Name</label>
		<input type="text" name="lname" value="<?=$employee['EmplLastName']?>" id="lname">
		<label for="email">Email</label>
		<input type="email" name="email" value="<?=$employee['EmplEmail']?>" id="email">
		<label for="dob">Date of Birth</label>
		<input type="date" name="dob" value=<?=$employee['EmplDateofBirth']?> id="dob">
		<label for="department">Department</label>
		<select name="department">
		<option value="Executive" <?php if($employee['EmplDepartment'] == 'Executive'){echo("selected");}?> >Executive</option>
			<option value="Engineering" <?php if($employee['EmplDepartment'] == 'Engineering'){echo("selected");}?> >Engineering</option>
			<option value="Accounting" <?php if($employee['EmplDepartment'] == 'Accounting'){echo("selected");}?> >Accounting</option>
			<option value="Logistics" <?php if($employee['EmplDepartment'] == 'Logistics'){echo("selected");}?> >Logistics</option>
			<option value="Sales"<?php if($employee['EmplDepartment'] == 'Sales'){echo("selected");}?>  >Sales</option>
			<option value="Research" <?php if($employee['EmplDepartment'] == 'Research'){echo("selected");}?> >Research</option>
			<option value="Marketing" <?php if($employee['EmplDepartment'] == 'Marketing'){echo("selected");}?> >Marketing</option>
			<option value="IT Systems" <?php if($employee['EmplDepartment'] == 'IT Systems'){echo("selected");}?> >IT Systems</option>
		</select>
	</div>
		<input type="submit" value="Update">
		<p>&nbsp;</p>
		<input type="reset">
	</form>
	<?php if ($msg): ?>
	<p><?=$msg?></p>
	<?php endif; ?>
</div>

<?=make_footer()?>
