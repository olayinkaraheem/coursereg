<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $faculty app\models\Faculties */
/* @var $form ActiveForm */
?>

<h2 class="page-header">Create Faculty</h2>
<div class="faculties-create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($faculty, 'faculty_name') ?>
        <?= $form->field($faculty, 'faculty_code') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- faculties-create -->
