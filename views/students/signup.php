<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Departments;
use app\models\Faculties;

/* @var $this yii\web\View */
/* @var $new_student app\models\Students */
/* @var $form ActiveForm */
?>

<h2 class="page-header">New Student Registration</h2>
<p><span class="text-danger">* You won't be able to edit your profile after submission. So check through before submitting this form.</span></p>
<div class="site-new_student">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($new_student, 'student_firstname') ?>
        <?= $form->field($new_student, 'student_lastname') ?>
        <?= $form->field($new_student, 'student_email') ?>
        <?= $form->field($new_student, 'faculty_id')
            ->dropDownList(Faculties::find()
            ->select(['faculty_name', 'faculty_id'])
            ->indexBy('faculty_id')
            ->column(), [
                'prompt'=>'Select Faculty',
                'onchange'=>'
                            $.post("'.Yii::$app->urlManager->createUrl('/departments/list-dept-by-faculty?id=').'"+$(this).val(), function(data){
                            $("select#students-dept_id").html(data);
                        });'
                    ]); ?>
        <?= $form->field($new_student, 'dept_id')
            ->dropDownList(Departments::find()
            ->select(['dept_name', 'dept_id'])
            ->indexBy('dept_id')
            ->column(), ['prompt'=>'Select Department']); ?>
        <?= $form->field($new_student, 'username') ?>
        <?= $form->field($new_student, 'student_password')->passwordInput() ?>
        <?= $form->field($new_student, 'password_repeat')->passwordInput(); ?>
    
        <div class="form-group">
            <?= Html::submitButton('Register', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-new_student -->
