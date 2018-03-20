<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Faculties;

/* @var $this yii\web\View */
/* @var $deaprtment app\models\Departments */
/* @var $form ActiveForm */
?>
<a href="index">Back To Department List</a>
<h2 class="page-header">
	Create Department
</h1>
<div class="departments-create">


    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($department, 'dept_name') ?>
        <?= $form->field($department, 'dept_code') ?>
        <?= $form->field($department, 'faculty_id')->dropDownList(
        							Faculties::find()
        							->select(['faculty_name','faculty_id'])
        							->indexBy('faculty_id')
        							->column(),
        							['prompt'=>'Select Faculty']
        		)	?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- departments-create -->
