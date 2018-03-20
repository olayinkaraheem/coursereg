<?php
/* @var $this yii\web\View */

    use yii\helpers\Html;

?>
<a href="index">Back To Course List</a>
<h2 class="page-header">
    <?=$course->course_title?> Course Details
    <span class="pull-right"><a href="edit?id=<?=$course->course_id?>" class="btn btn-default">Edit</a> <a href="delete?id=<?=$course->course_id?>" class="btn btn-danger">Delete</a></span>
</h1>

<ul class="list-group">
    
    <li class="list-group-item"><strong>Course Title : </strong><?=$course->course_title?></li>
    <li class="list-group-item"><strong>Course Code : </strong><?=$course->course_code?></li>

</ul>