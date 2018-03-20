<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


use yii\helpers\ArrayHelper;
use app\models\Departments;
use app\models\Faculties;
use app\models\Courses;
use app\models\CourseReg;

/* @var $this yii\web\View */
/* @var $new_reg app\models\CourseReg */
/* @var $form ActiveForm */
?>



<?php
/* @var $this yii\web\View */
?>


<h2 class="page-header">New Course Registration</h2>

<!-- <?php// echo Yii::$app->user->identity->id;?> -->

<div class="registration-register">
<?php if($check) : ?>

    <?php if($reg_status === 'Pending') : ?>

    <p>You Already Registered Your Courses. Awaiting Approval. <a href="index">View</a></p>

    <?php elseif($reg_status === 'Approved') : ?>
        <p>You Already Registered Your Courses. Registration <?=$approved->reg_status?>. <a href="index">View</a></p>
        <p>Remarks: <?=$approved->comment?></p>

    <?php elseif($reg_status === 'Unapproved') : ?>
       <p>You Registration Was Unapproved. <a href="re_reg?id=<?=Yii::$app->user->identity->id?>">Register</a> again.</p>
        <p>Remarks: <?=$unapproved->comment?></p>
    <?php else : ?>

    <?php endif; ?>
<?php else: ?>

    <?php $form = ActiveForm::begin([
        'options'=>['id'=>'course-form']
        ]); ?>

        <?= $form->errorSummary($new_reg); ?>

        <div class="form-group course-input">

            <?= Html::dropDownList('faculty_id',$selection = null, Faculties::find()
                    ->select(['faculty_name', 'faculty_id'])
                    ->indexBy('faculty_id')
                    ->column(), [
                        'prompt'=>'Select Faculty',
                        'onchange'=>'
                            $.post("'.Yii::$app->urlManager->createUrl('/departments/list-dept-by-faculty?id=').'"+$(this).val(), function(data){
                            $("select[name=dept_id]").html("<option value=\"\">--Select Department--</option>"+data);
                        });'
                    ], ['class'=>'form-control'])?>
            <?= Html::dropDownList('dept_id', $selection = null, Departments::find()
                    ->select(['dept_name', 'dept_id'])
                    ->indexBy('dept_id')
                    ->column(), [
                        'prompt'=>'Select Department',
                        'onchange'=>'
                            

                                    $.post("'.Yii::$app->urlManager->createUrl('/courses/list-courses?id=').'"+$(this).val(), function(data){
                                
                                
                                        $("#coursereg-courses").append(data);

                                    
                                
                                
                                
                            });
                            

                            ']); ?>
            <?= $form->field($new_reg, 'courses')->checkBoxList([]) ?>

        </div>
        
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary pull-right']) ?>
        </div>
    <?php ActiveForm::end(); ?>

<?php endif; ?>

<!-- $.each(selectedDept, function(ind, deptid){
                                if($("select[name=dept_id]").val()===deptid){

                                    console.log("I am here");

                                } else{

                                    selectedDept.push($(this).val());

                                    console.log(selectedDept);

                                    $.post("'.Yii::$app->urlManager->createUrl('/courses/list-courses?id=').'"+$(this).val(), function(data){
                                
                                
                                        $("#coursereg-courses").append(data);

                                    
                                
                                });
                                }
                            }) -->





    <!-- <button type="button" class="btn btn-default pull-left" id="add-course-btn">Add</button> -->

</div><!-- registration-register -->

