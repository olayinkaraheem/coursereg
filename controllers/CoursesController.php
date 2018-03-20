<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Students;
use app\models\Courses;

use yii\data\Pagination;

class CoursesController extends Controller {

       /*

    * Access Control

    */ 

    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','index', 'details', 'edit', 'delete'],
                'rules' => [
                    [
                        'actions' => ['create', 'index', 'details', 'edit', 'delete'],
                        'allow' => true,
                        'roles'=> ['@'],
                    ]
                ]

            ]

        ];
    }

    public function actionCreate(){
       $course = new Courses;

       if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }

    if ($course->load(Yii::$app->request->post())) {
        if ($course->validate()) {
            
            $course->save();
            Yii::$app->session->setFlash('created', 'Course Created Successfully');
            return $this->redirect('index');
        }
    }

    return $this->render('create', [
        'course' => $course,
    ]);
    }

     public function actionDelete($id){
        if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }
        $course= Courses::find()
                    ->where(['course_id'=>$id])
                    ->one();
        $course->delete();
        Yii::$app->session->setFlash('deleted', 'Course Deleted Successfully');
        return $this->redirect('index');
    }

    public function actionEdit($id){
        if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }
        $course = Courses::find()
                    ->where(['course_id'=>$id])
                    ->one();

        if ($course->load(Yii::$app->request->post())) {
            if ($course->validate()) {
                
                $course->save();
                Yii::$app->session->setFlash('updated', 'Course Updated Successfully');
                return $this->redirect('index');
            }
        }
        return $this->render('edit', ['course'=>$course]);
    }

    public function actionDetails($id){
        if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }
        $course = Courses::find()
                    ->where(['course_id'=>$id])
                    ->one();

        return $this->render('details', ['course'=>$course]);
    }

    public function actionIndex(){
        if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }

        $query = Courses::find();

        $coursesCount = $query->count();

        $pagination = new Pagination([

            'defaultPageSize'=> 20,
            'totalCount'=>$coursesCount,

        ]);

        $courses = $query
                    ->orderBy('course_title ASC')
                    ->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();

        return $this->render('index', ['courses'=>$courses, 'pagination'=>$pagination]);
    }

    public function actionListCourses($id){
       
        $courseCount = Courses::find()
                ->where(['dept_id'=>$id])
                ->count();


        $courses = Courses::find()
                ->where(['dept_id'=>$id])
                ->all();


        if($courseCount>0){
            foreach($courses as $course){


                // echo "<option name='courses' value='".$course->course_code."'>".$course->course_code."</option>";


                echo "<label><input type='checkbox' name='CourseReg[".$course->course_id."]' value='".$course->course_id."'>".$course->course_code."</label><br>";


            }
        } else {
            
            // echo "<option></option>";
        }

    }

}
