<?php

namespace app\models;

use Yii;

use yii\base\Model;
use yii\base\Security;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "students".
 *
 * @property int $student_id
 * @property string $student_firstname
 * @property string $student_lastname
 * @property string $student_email
 * @property string $dept_name
 * @property string $faculty_name
 */
class Students extends ActiveRecord implements IdentityInterface {

    public $password_repeat;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_firstname', 'student_lastname', 'student_email','username','student_password', 'dept_id', 'faculty_id'], 'required'],
            [['student_firstname', 'student_lastname', 'dept_id', 'faculty_id'], 'string'],
            [['student_email', 'username'], 'string', 'max' => 255],
            ['password_repeat','compare','compareAttribute' => 'student_password']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_id' => 'Student ID',
            'student_firstname' => 'Firstname',
            'student_lastname' => 'Lastname',
            'student_email' => 'Email',
            'username' => 'Username',
            'student_password' => 'Password',
            'dept_id' => 'Deptartment',
            'faculty_id' => 'Faculty',
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id){
        return static::findOne($id);
    }


    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null){
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId(){
        return $this->student_id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey(){
        return $this->auth_key;
    }

    public function validatePassword($password){

        $hash = '$2y$10$myownfunnyhashstring22';

        return $this->student_password === crypt($password, $hash); // always remember, password before hashsalt
    }

    public function findByUsername($username){
        return Students::findOne(['username' => $username]);
    }
    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey){
        return $this->getAuthKey() === $authKey;
    }


    public function getCourseReg(){
        return $this->hasOne(CourseReg::className(), ['student_id' => 'student_id']);
    }




    public function getFaculties(){
        return $this->hasOne(Faculties::className(), ['faculty_id' => 'faculty_id']); 
    }

    public function getDepartments(){
        return $this->hasOne(Departments::className(), ['dept_id' => 'dept_id']);
    }

    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }
            if(isset($this->student_password)){
                $hash = '$2y$10$myownfunnyhashstring22';
                $this->student_password = crypt($this->student_password, $hash);
                return parent::beforeSave($insert);
            }
            return true;
        }
        return false;
    }
}