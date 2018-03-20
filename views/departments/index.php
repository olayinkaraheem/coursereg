<?php
/* @var $this yii\web\View */
	use yii\helpers\Html;

	use yii\widgets\LinkPager;
?>
<h2 class="page-header">
	All Departments
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
		<th>Department Name</th>
		<th>Department Code</th>
	</thead>
	<tbody>
		<?php foreach($departments as $department) : ?>
			<tr>
				<td><a href="details?id=<?=$department->dept_id?>"><?=$department->dept_name?></a></td>
				<td><?=$department->dept_code?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?= LinkPager::widget(['pagination'=>$pagination]) ?>
