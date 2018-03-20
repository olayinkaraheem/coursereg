<?php
/* @var $this yii\web\View */
	use yii\helpers\Html;

	use yii\widgets\LinkPager;
?>
<h2 class="page-header">
	All Facuties
	<span class="pull-right"><a href="create" class="btn btn-primary">Create</a></span>
</h1>

<table class="table table-bordered table-striped">
	<thead>
		<th>Faculty Name</th>
		<th>Faculty Code</th>
	</thead>
	<tbody>
		<?php foreach($faculties as $faculty) : ?>
			<tr>
				<td><a href="details?id=<?=$faculty->faculty_id?>"><?=$faculty->faculty_name?></a></td>
				<td><?=$faculty->faculty_code?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?= LinkPager::widget(['pagination'=>$pagination]) ?>