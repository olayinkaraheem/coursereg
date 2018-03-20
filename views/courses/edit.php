<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Departments;
use app\models\Faculties;

/* @var $this yii\web\View */
/* @var $course app\models\Courses */
/* @var $form ActiveForm */
?>
<a href="index">Back To Course List</a>
<h2 class="page-header">Edit Course</h2>

<div class="courses-edit">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($course, 'faculty_id')->dropDownList(Faculties::find()
        				->select(['faculty_name', 'faculty_id'])
        				->indexBy('faculty_id')
        				->column(),
        				['prompt'=>'Select Faculty',
                        'onchange'=>'
                            $.post("'.Yii::$app->urlManager->createUrl('/departments/list-dept-by-faculty?id=').'"+$(this).val(), function(data){
                            $("select#courses-dept_id").html(data);
                        });'
        				])
        			?>
        <?= $form->field($course, 'dept_id')
        				->dropDownList(Departments::find()
        				->select(['dept_name', 'dept_id'])
        				->indexBy('dept_id')
        				->column(),
        				['prompt'=>'Select Department']
        				)
        			?>
        <?= $form->field($course, 'course_title') ?>
        <?= $form->field($course, 'course_code') ?>
        <?= $form->field($course, 'course_unit') ?>
        <?= $form->field($course, 'lecturer_id') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- courses-create -->
