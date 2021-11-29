<?php
	include 'config.php';
	$connection = create_connection();
	$msg = '';
	//Check that the ID exists
	if (isset($_GET['id'])) {
		//Select the record
		$stmt = $connection->prepare('SELECT * FROM EMPLOYEE WHERE Empl_ID = ?');
		$stmt->execute([$_GET['id']]);
		$employee = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$employee) {
			exit('Employee does not exist with that ID.');
			sleep(3);
			header('Location: read.php');
		}
		if (isset($_GET['confirm'])) {
			if ($_GET['confirm'] == 'yes') {
				$stmt = $connection->prepare('DELETE FROM EMPLOYEE WHERE Empl_ID = ?');
				$stmt->execute([$_GET['id']]);
				$msg = 'Employee deleted.';
				sleep(3);
				header('Location: read.php');
			} else {
				header('Location: read.php');
				exit;
			}
		}
	} else {
		exit('No ID specified.');
	}
?>

<?=make_header('Delete')?>

<div class="delete">
	<h2>Delete Employee <?=$employee['Empl_ID']?></h2>
	<?php if ($msg): ?>
	<p><?=$msg?></p>
	<?php else: ?>
	<p>Are you sure you want to delete employee <?=$employee['Empl_ID']?>?</p>
	<div class="yesno">
		<a href="delete.php?id=<?=$employee['Empl_ID']?>&confirm=yes">Yes</a>
		<a href="delete.php?id=<?=$employee['Empl_ID']?>&confirm=no">No</a>
	</div>
	<?php endif; ?>
</div>

<?=make_footer()?>
