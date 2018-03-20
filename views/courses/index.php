<?php
/* @var $this yii\web\View */
	use yii\helpers\Html;

	use yii\widgets\LinkPager;
?>
<h2 class="page-header">
	Available Courses
	<span class="pull-right"><a href="create" class="btn btn-primary">Create</a></span>
</h1>

<?php if(Yii::$app->session->hasFlash('deleted')): ?>
	<div class="alert alert-danger"><?=Yii::$app->session->getFlash('deleted');?></div>
<?php endif; ?>
<?php if(Yii::$app->session->hasFlash('created')): ?>
	<div class="alert alert-success"><?=Yii::$app->session->getFlash('created');?></div>
<?php endif; ?>
<?php if(Yii::$app->session->hasFlash('updated')): ?>
	<div class="alert alert-success"><?=Yii::$app->session->getFlash('updated');?></div>
<?php endif; ?>

<table class="table table-bordered table-striped">
	<thead>
		<th>Course Title</th>
		<th>Course Code</th>
		<th>Course Unit Points</th>
		<th>Faculty</th>
		<th>Department</th>
	</thead>
	<tbody>
		<?php foreach($courses as $course) : ?>
			<tr>
				<td><a href="details?id=<?=$course->course_id?>"><?=$course->course_title?></a></td>
				<td><?=$course->course_code?></td>
				<td><?=$course->course_unit?></td>
				<td><?=$course->faculties->faculty_name?></td>
				<td><?=$course->departments->dept_name?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?= LinkPager::widget(['pagination'=>$pagination]) ?>