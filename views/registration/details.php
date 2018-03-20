<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Courses;
/* @var $this yii\web\View */
/* @var $model app\models\CourseReg */
/* @var $form ActiveForm */
	
?>
<?php if(Yii::$app->session->hasFlash('Reg_Success')) : ?>
	<div class="alert alert-success"><?=Yii::$app->session->getFlash('Reg_Success');?></div>
<?php endif; ?>

<h2 class="page-header">Course Details</h2>

<p>
	<a href='pending' class="btn btn-warning">All Pending</a>
</p>

<div class="registration-details">

<?php if($reg) : ?>

	<?php
		$courses = json_decode($reg->courses);
	?>
	<ul class="list-group">
		<li class="list-group-item"><strong>First Name:</strong> <?=$reg->students->student_firstname?></li>
		<li class="list-group-item"><strong>last Name:</strong> <?=$reg->students->student_lastname?></li>
		<li class="list-group-item"><strong>Faculty Name:</strong> <?=$reg->students->faculties->faculty_name?></li>
		<li class="list-group-item"><strong>Department Name:</strong> <?=$reg->students->departments->dept_name?></li>
		<li class="list-group-item"><strong>Registration Status:</strong> <?=$reg->reg_status?></li>
	</ul>
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

	<p></p>

<?php endif; ?>



    <?php $form = ActiveForm::begin(); ?>

    	<?= $form->errorSummary($reg); ?>

        <?= $form->field($reg, 'comment')->textArea(['cols'=>6]) ?>
        <?= $form->field($reg, 'reg_status')->dropDownList(['Approved'=>'Approve','Unapproved'=>'Unapprove'], ['prompt'=>'Select Status']) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- registration-details -->
