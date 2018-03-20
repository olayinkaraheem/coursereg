<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "courses".
 *
 * @property int $course_id
 * @property string $course_title
 * @property string $course_code
 * @property int $course_unit
 * @property int $dept_id
 * @property int $faculty_id
 * @property int $lecturer_id
 */
class Courses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_title', 'course_code', 'course_unit', 'dept_id', 'faculty_id', 'lecturer_id'], 'required'],
            [['course_title'], 'string'],
            [['course_unit', 'dept_id', 'faculty_id', 'lecturer_id'], 'integer'],
            [['course_code'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'course_id' => 'Course ID',
            'course_title' => 'Course Title',
            'course_code' => 'Course Code',
            'course_unit' => 'Course Unit',
            'dept_id' => 'Department',
            'faculty_id' => 'Faculty',
            'lecturer_id' => 'Lecturer',
        ];
    }



    public function getCourseRegs(){
        return $this->hasMany(CourseReg::className(), ['course_id' => 'course_id']); //map the user_id of jobs table/model to the id in our users table/model
    }


    public function getDepartments(){
        return $this->hasOne(Departments::className(), ['dept_id' => 'dept_id']); //map the user_id of jobs table/model to the id in our users table/model
    }


    public function getFaculties(){
        return $this->hasOne(Faculties::className(), ['faculty_id' => 'faculty_id']); //map the user_id of jobs table/model to the id in our users table/model
    }
}
