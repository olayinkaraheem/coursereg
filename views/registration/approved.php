<?php

	use yii\helpers\Html;
	use app\models\User;

?>

<h2 class="page-header">Approved Registrations</h2>

<?php if($approved) : ?>

	<p>
		<a href='pending' class="btn btn-warning">All Pending</a>
		<a href='unapproved' class="btn btn-danger">All Unapproved</a>
	</p>

	<table class="table table-striped table-hover table-bordered">
		<thead>
				<th>Student ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Student Faculty</th>
				<th>Student Department</th>
				<th>Registration Status</th>
		</thead>

		<?php foreach($approved as $course) : ?>

			
				<tr>
					<td>
						<a href="details?id=<?=$course->student_id?>"><?=$course->student_id?></a>
					</td>
					<td>
						<?=$course->students->student_firstname?>
					</td>
					<td>
						<?=$course->students->student_lastname?>
					</td>
					<td>
						<?=$course->students->faculties->faculty_name?>
					</td>
					<td>
						<?=$course->students->departments->dept_name?>
					</td>
					<td>
						<a href="details?id=<?=$course->student_id?>"><?= $course->reg_status ?></a>
					</td>
				</tr>


		<?php endforeach;?>
	</table>

	<?php else: ?>
		
	<p>No pending registration(s)</p>

<?php endif;?>