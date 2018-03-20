<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property int $dept_id
 * @property string $dept_name
 * @property string $dept_code
 * @property int $faculty_id
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dept_name', 'dept_code', 'faculty_id'], 'required'],
            [['dept_name', 'dept_code'], 'string'],
            [['faculty_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dept_id' => 'Dept ID',
            'dept_name' => 'Dept Name',
            'dept_code' => 'Dept Code',
            'faculty_id' => 'Faculty ID',
        ];
    }


    public function getStudents(){
        return $this->hasMany(Students::className(), ['dept_id' => 'dept_id']); //map the user_id of jobs table/model to the id in our users table/model
    }



    public function getFaculties(){
        return $this->hasMany(Faculties::className(), ['faculty_id' => 'faculty_id']); //map the user_id of jobs table/model to the id in our users table/model
    }


    public function getCourseReg(){
        return $this->hasMany(CourseReg::className(), ['dept_id' => 'dept_id']); //map the user_id of jobs table/model to the id in our users table/model
    }

    public function getCourses(){
        return $this->hasMany(Courses::className(), ['dept_id' => 'dept_id']); //map the user_id of jobs table/model to the id in our users table/model
    }
}
