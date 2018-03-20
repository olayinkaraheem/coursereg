<?php
/* @var $this yii\web\View */

	use yii\helpers\Html;

?>
<a href="index">Back To Department List</a>
<h2 class="page-header">
	Faculty of <?=$department->dept_name?> Details
	<span class="pull-right"><a href="edit?id=<?=$department->dept_id?>" class="btn btn-default">Edit</a> <a href="delete?id=<?=$department->dept_id?>" class="btn btn-danger">Delete</a></span>
</h1>

<ul class="list-group">
	
	<li class="list-group-item"><strong>Department Name : </strong><?=$department->dept_name?></li>
	<li class="list-group-item"><strong>Department Code : </strong><?=$department->dept_code?></li>

</ul>
<script type="text/javascript">
	$(window).ready(function(){
		alert('I am here');
	});
</script>