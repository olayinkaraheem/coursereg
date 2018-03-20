<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\CourseReg;
use app\models\User;

class RegistrationController extends \yii\web\Controller {

        /*

    * Access Control

    */ 

    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['register_i','index', 'pending', 'unapproved', 'approved', 'details'],
                'rules' => [
                    [
                        'actions' => ['register_i', 'index', 'pending', 'unapproved', 'approved', 'details'],
                        'allow' => true,
                        'roles'=> ['@'],
                    ]
                ]

            ]

        ];
    }

    public function actionIndex(){
        $reg = CourseReg::find()
                ->where(['student_id'=>Yii::$app->user->identity->id])
                ->one();

        return $this->render('index', ['reg'=>$reg]);
    }

    // public function actionRegister(){
    //     $new_reg = new CourseReg();

    //     if ($new_reg->load(Yii::$app->request->post())) {
    //         if ($new_reg->validate()) {
                
    //             $new_reg->save();

    //             return $this->redirect('index');
    //         }
    //     }

    //     return $this->render('register', [
    //         'new_reg' => $new_reg,
    //     ]);
    // }

    public function actionRegister_i(){
        $new_reg = new CourseReg();

        // checking if he student has already registered

        
        $check = CourseReg::find()
                    ->where(['student_id'=>Yii::$app->user->identity->id])
                    ->one();

         if($check){
           $reg_status = CourseReg::find()
                    ->where(['student_id'=>Yii::$app->user->identity->id])
                    ->one()->reg_status;
            // checking if he student has been approved
            $pending = CourseReg::find()
                        ->where(['student_id'=>Yii::$app->user->identity->id, 'reg_status'=>'Pending'])
                        ->one(); 
            // checking if he student has been approved
            $approved = CourseReg::find()
                        ->where(['student_id'=>Yii::$app->user->identity->id, 'reg_status'=>'Approved'])
                        ->one();
            // checking if he student's Reg has been unapproved'
            $unapproved = CourseReg::find()
                    ->where(['student_id'=>Yii::$app->user->identity->id, 'reg_status'=>'Unapproved'])
                    ->one();
         }              

        

        if ($new_reg->load(Yii::$app->request->post())) {

            $post = Yii::$app->request->post();

            // clearing the value of the hidden in put and setting to an empty array

            $post['CourseReg']['courses'] = [];

            // looping through submitted values and push each of them into the above

            foreach($post['CourseReg'] as $key=>$value){

                //  if values not empty (for arrays) or > 0 for numbers

                if(!empty($value) && $value > 0 ){

                    array_push($post['CourseReg']['courses'],$value);

                }
            }

            // assigning the result of the above the a variable and setting input field 'courses'

            $courseList = $post['CourseReg']['courses'];

            $new_reg->courses = $courseList;

            // validating input

            if ($new_reg->validate()) {

                // saving it
                
                $new_reg->save();

                Yii::$app->session->setFlash('Reg_Success', 'Registration Successful');

                return $this->redirect('index');
                
            }
        }

        if($check){
            return $this->render('register_i', [
                'new_reg' => $new_reg, 'reg_status'=>$reg_status, 'approved'=>$approved, 'unapproved'=>$unapproved, 'check'=>$check
            ]);
        } else {
            return $this->render('register_i', [
                'new_reg' => $new_reg, 'check'=>$check
            ]);
        }

        
    }



    public function actionApproved(){
        $approved = CourseReg::find()
                    ->where(['reg_status'=>'Approved'])
                    ->all();

                    // echo "<pre>";
                    //     var_dump($approved);
                    // echo "</pre>";

                    // die();

        if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }
                  

        
        return $this->render('approved', [
            'approved' => $approved,
        ]);
    }

    public function actionPending(){
        // $recieved = CourseReg::find()
        //         ->select('reg_status')
        //         ->column();
        $courses = CourseReg::find()
                    ->where(['reg_status'=>'Pending'])
                    ->all();
                    // echo "<pre>";
                    //     var_dump($courses);
                    // echo "</pre>";
                    // die();
        
        return $this->render('pending', [
            'courses' => $courses
        ]);
    }


    public function actionUnapproved(){
        $unapproved = CourseReg::find()
                    ->where(['reg_status'=>'Unapproved'])
                    ->all();

        if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }


        
        return $this->render('unapproved', [
            'unapproved' => $unapproved,
        ]);
    }

    public function actionDetails($id){

        if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }
        
         $reg = CourseReg::find()
                ->where(['student_id'=>$id])
                ->one();

        

        if ($reg->load(Yii::$app->request->post())) {
            
                // $reg->courses = $reg->courses;
                

                if ($reg->validate()) {
                    
                    $reg->save();

                   Yii::$app->session->setFlash('Reg_Success', 'Action Successful');

                   
                }
            
                

                
            
        }

        return $this->render('details', ['reg'=>$reg]);
    }

    public function actionRe_reg($id){
        $to_del= CourseReg::find()
                    ->where(['student_id'=>$id])
                    ->one();

        $to_del->delete();

        return $this->redirect('register_i');
    }



    // public function getRegStatus(){
    //     return ['Approved','Unapproved'];
    // }

}
