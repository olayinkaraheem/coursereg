<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faculties".
 *
 * @property int $faculty_id
 * @property string $faculty_name
 * @property string $faculty_code
 */
class Faculties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faculties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faculty_name', 'faculty_code'], 'required'],
            [['faculty_name', 'faculty_code'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'faculty_id' => 'Faculty ID',
            'faculty_name' => 'Faculty Name',
            'faculty_code' => 'Faculty Code',
        ];
    }



    public function getStudents(){
        return $this->hasMany(Students::className(), ['faculty_id' => 'faculty_id']); //map the user_id of jobs table/model to the id in our users table/model
    }


    public function getDepartments(){
        return $this->hasMany(Departments::className(), ['faculty_id' => 'faculty_id']); //map the user_id of jobs table/model to the id in our users table/model
    }

    public function getCourses(){
        return $this->hasMany(Courses::className(), ['faculty_id' => 'faculty_id']); //map the user_id of jobs table/model to the id in our users table/model
    }

    // public function getCoursesReg(){
    //     return $this->hasMany(CourseReg::className(), ['faculty_id' => 'faculty_id']); //map the user_id of jobs table/model to the id in our users table/model
    // }
    
}
