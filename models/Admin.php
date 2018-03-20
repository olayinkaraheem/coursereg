<?php

namespace app\models;

use Yii;

use yii\base\Model;
use yii\base\Security;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "admin".
 *
 * @property int $admin_id
 * @property string $admin_fname
 * @property string $admin_lname
 * @property string $admin_username
 * @property string $admin_password
 * @property string $admin_role
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_fname', 'admin_lname', 'admin_username', 'admin_password', 'admin_role'], 'required'],
            [['admin_role'], 'string'],
            [['admin_fname', 'admin_lname', 'admin_username'], 'string', 'max' => 100],
            [['admin_password'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'Admin ID',
            'admin_fname' => 'Admin Fname',
            'admin_lname' => 'Admin Lname',
            'admin_username' => 'Admin Username',
            'admin_password' => 'Admin Password',
            'admin_role' => 'Admin Role',
        ];
    }

// /////////////////////////////////////////////////////////////////////


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
        return $this->admin_id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey(){
        return $this->auth_key;
    }

    public function validatePassword($password){

        $hash = '$2y$10$myownfunnyhashstring22';

        return $this->admin_password === crypt($password, $hash); // always remember, password before hashsalt
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


    // public function getCourseRegs(){
        // return $this->hasMany(CourseReg::className(), ['student_id' => 'student_id']); //map the user_id of jobs table/model to the id in our users table/model
    // }




    // public function getFaculties(){
        // return $this->hasOne(Faculties::className(), ['faculty_id' => 'faculty_id']); //mapping id (in CATEGORY table/model) to the category_id (in the JOBS table/model)
    // }

    // public function getDepartments(){
    //     return $this->hasOne(Departments::className(), ['dept_id' => 'dept_id']);
    // }

    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }
            if(isset($this->student_password)){
                $hash = '$2y$10$myownfunnypassstring22';
                $this->admin_password = crypt($this->admin_password, $hash);
                return parent::beforeSave($insert);
            }
            return true;
        }
        return false;
    }
}
