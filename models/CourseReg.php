<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "course_reg".
 *
 * @property int $reg_id
 * @property int $student_id
 * @property string $course_id
 * @property string $reg_status
 */
class CourseReg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course_reg';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['courses'], 'required'],
            [['comment'], 'string'],
            [['student_id'], 'integer'],
            [['reg_status'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reg_id' => 'Reg ID',
            'student_id' => 'Student ID',
            'courses' => 'Courses',
            'comment' => 'Comment',
            'reg_status' => 'Reg Status',
        ];
    }

    // public function getCourses(){
    //     return $this->hasOne(Courses::className(), ['course_id' => 'course_id']);
    // }



    // public function getUser(){
    //     return $this->hasOne(User::className(), ['id' => 'student_id']);
    // }

    public function getStudents(){
        return $this->hasOne(Students::className(), ['student_id' => 'student_id']);
    }

    public function getStudentsFirstname(){
        return $this->students->student_firstname;
    }

    public function beforeSave($insert){
        
         if($this->isNewRecord){
                $this->student_id = Yii::$app->user->identity->id;
               $this->courses = json_encode($this->courses); 
               // $this->reg_status = 'Pending'; 
            }
        
        // $this->course_id = json_encode([Yii::$app->session->getFlash('Courses')]);
        return parent::beforeSave($insert);
    }
}
