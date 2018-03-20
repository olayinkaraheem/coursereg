<?php

	use yii\helpers\Html;
	use app\models\Students;

?>

<h2 class="page-header">Pending Registrations</h2>

<?php if($courses) : ?>
	<!-- <pre>
	<?php //var_dump($courses[1]); die(); ?>
</pre> -->
	<p>
		<a href='approved' class="btn btn-success">All Approved</a>
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
	
		<tbody>
			<?php foreach($courses as $course) : ?>

				<?php

					// $student = Students::find()
					// 	->where(['student_id'=>$course->student_id])
					// 	->one();

				?>

				
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
		</tbody>
	</table>

	<?php else: ?>
		
	<p>No pending registration(s)</p>

<?php endif;?>