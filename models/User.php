<?php

namespace app\models;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $role;
    public $student_firstname;
    public $student_lastname;
    public $admin_fname;
    public $admin_lname;
    public $dept_id;
    public $faculty_id;

    private static $users = [
        '1' => [
            'id' => 1,
            'admin_fname' => 'super',
            'admin_lname' => 'admin',
            'username' => 'admin',
            'password' => '$2y$10$myownfunnyhashstring2uATGq9bguNOfrl548RrsIArzir4PC8u6',
            'authKey' => 'jbnku5iorjg98ujoi3w98yhw897yhser89uhr89h',
            'accessToken' => '100-token',
            'role'=>'admin'
        ],
        '10' => [
            'id' => 10,
            'student_firstname' => 'Demo',
            'student_lastname' => 'Demo',
            'username' => 'demo',
            'password' => '$2y$10$myownfunnyhashstring2ux.MI0prgHHj.DDEVWVIQBwTJpPrlQFm',
            'faculty_id'=>2,
            'dept_id'=>2,
            'authKey' => 'test2key',
            'accessToken' => '2-token',
            'role' => 'student',
        ],
        '8' => [
            'id' => 8,
            'student_firstname' => 'Joseph',
            'student_lastname' => 'Maryam',
            'username' => 'maryam',
            'password' => '$2y$10$myownfunnyhashstring2ufpv2Qbi.jukYIuVNf3SQALtVvbEgBZa', 
            'authKey' => 'test005key',
            'faculty_id'=>3,
            'dept_id'=>10,
            'accessToken' => '005-token',
            'role' => 'student',
        ],
        '7' => [
            'id' => 7,
            'student_firstname' => 'Adayi',
            'student_lastname' => 'David',
            'username' => 'adayi',
            'password' => '$2y$10$myownfunnyhashstring2u/uLyKio9m0Lj6BwGvGAseeisFyuv8he',
            'faculty_id'=>1,
            'dept_id'=>1,
            'authKey' => 'test303key',
            'accessToken' => '303-token',
            'role' => 'student',
        ],


        '6' => [
            'id' => 6,
            'student_firstname' => 'Ayanwale',
            'student_lastname' => 'Ajewunmi',
            'username' => 'asquared',
            'password' => '$2y$10$myownfunnyhashstring2uDFhlOK39N/44Gowv8OzYfx9OgWDZaqy',
            'faculty_id'=>2,
            'dept_id'=>2,
            'authKey' => 'test6key',
            'accessToken' => '6-token',
            'role' => 'student',
        ],

        '9' => [
            'id' => 9,
            'student_firstname' => 'James',
            'student_lastname' => 'Amadi',
            'username' => 'james',
            'password' => '$2y$10$myownfunnyhashstring2uet0I01wzX1gqTzANTUZlVtMRQsa8ZIC',
            'faculty_id'=>2,
            'dept_id'=>2,
            'authKey' => 'test004key',
            'accessToken' => '004-token',
            'role' => 'student',
        ],
    ];


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {

        $hash = '$2y$10$myownfunnyhashstring22';

        
        return $this->password === crypt($password, $hash);
    }

//     public function getCourseReg(){
//         return $this->hasOne(CourseReg::className(), ['student_id'=>'id']);
//     }
}
