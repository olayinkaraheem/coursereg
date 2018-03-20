<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $faculty app\models\Faculties */
/* @var $form ActiveForm */
?>
<a href="index">Back To Department List</a>
<h2 class="page-header">Edit Department</h2>

<div class="faculties-edit">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($department, 'dept_name') ?>
        <?= $form->field($department, 'dept_code') ?>

        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- faculties-edit -->