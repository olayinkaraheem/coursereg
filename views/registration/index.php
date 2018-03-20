<?php
	use app\models\Courses;
?>

<h2 class="page-header">Registered Courses</h2>

<?php if(Yii::$app->session->hasFlash('Reg_Success')) : ?>
	<div class="alert alert-success"><?=Yii::$app->session->getFlash('Reg_Success');?></div>
<?php endif; ?>

<?php if($reg) : ?>

	

	<?php
		$courses = json_decode($reg->courses);
	?>

	<table class="table table-striped table-hover table-bordered">
		<thead>
			<th>Course Title</th>
			<th>Course Code</th>
			<th>Course Unit</th>
		</thead>
		<tbody>
			<?php foreach($courses as $course=>$id) : ?>

				<?php

					$course = Courses::find()
						->where(['course_id'=>$id])
						->one();

				?>
				<tr>
					<td>

						<?=$course->course_title; ?>
							
					</td>
					<td>

						<?=$course->course_code; ?>
							
					</td>
					<td>

						<?=$course->course_unit; ?>
							
					</td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>

	<p><a class="btn btn-default" href="register_i">Check Status</a></p>

<?php else: ?>

	<p>You are yet to register. Would you like to do so now? <a href="register_i">Register</a></p>

<?php endif; ?>