<?php
	include 'config.php';
	//connect to MariaDB
	$connection = create_connection();
	$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
	$records_per_page = 5;

	//prepare the SQL statement and get the records from our employee table
	$stmt = $connection->prepare('SELECT * FROM EMPLOYEE ORDER BY CreatedAt LIMIT :current_page, :record_per_page');
	$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
	$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
	$stmt->execute();
	// fetch the records for display
	$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// Get the total number of employees
	$num_employees = $connection->query('SELECT COUNT(*) FROM EMPLOYEE')->fetchColumn();
?>
<!-- Template the table and fill with data from employees--!>
<?=make_header('Read')?>

	<div class="read">
		<h2>Employees</h2>
		<a href="create.php" class="create">Create New Employee</a>
		<table>
			<thead>
				<tr>
					<td>ID</td>
					<td>First Name</td>
					<td>Last Name</td>
					<td>Email</td>
					<td>Date of Birth</td>
					<td>Department</td>
					<td>Created</td>
					<td>Updated</td>
				<tr>
			</thead>
			<tbody>
				<?php foreach ($employees as $employee): ?>
				<tr>
					<td><?=$employee['Empl_ID']?></td>

					<td><?=$employee['EmplFirstName']?></td>
					<td><?=$employee['EmplLastName']?></td>
					<td><?=$employee['EmplEmail']?></td>
					<td><?=$employee['EmplDateofBirth']?></td>
					<td><?=$employee['EmplDepartment']?></td>
					<td><?=$employee['CreatedAt']?></td>
					<td><?=$employee['UpdatedAt']?></td>
					<td class="actions">
						<a href="update.php?id=<?=$employee['Empl_ID']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
						<a href="delete.php?id=<?=$employee['Empl_ID']?>" class="trash"><i class="fas fa-pen fa-xs"></i></a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_employees): ?>
		<a href="read.php?page=<?=$page+1?>"<i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>

<?=make_footer()?>
