<?php

	use yii\helpers\Html;
	use app\models\User;

?>



<h2 class="page-header">Unapproved Registrations</h2>
<p>
	<a href='pending' class="btn btn-warning">All Pending</a>
	<a href='approved' class="btn btn-success">All Approved</a>
</p>
<?php if($unapproved) : ?>

	

	<table class="table table-striped table-hover table-bordered">
		<thead>
				<th>Student ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Student Faculty</th>
				<th>Student Department</th>
				<th>Registration Status</th>
		</thead>

		<?php foreach($unapproved as $course) : ?>

			
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
		
	<p>No Unapproved registration(s)</p>

<?php endif;?>