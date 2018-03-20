<?php
/* @var $this yii\web\View */

	use yii\helpers\Html;

?>
<h2 class="page-header">
	Faculty of <?=$faculty->faculty_name?> Details
	<span class="pull-right"><a href="edit?id=<?=$faculty->faculty_id?>" class="btn btn-default">Edit</a> <a href="delete?id=<?=$faculty->faculty_id?>" class="btn btn-danger">Delete</a></span>
</h1>

<ul class="list-group">
	
	<li class="list-group-item"><strong>Faculty Name : </strong><?=$faculty->faculty_name?></li>
	<li class="list-group-item"><strong>Faculty Code : </strong><?=$faculty->faculty_code?></li>

</ul>
<script type="text/javascript">
	$(window).ready(function(){
		alert('I am here');
	});
</script>