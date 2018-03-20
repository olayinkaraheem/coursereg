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
use app\models\Departments;
use yii\data\Pagination;

class DepartmentsController extends \yii\web\Controller
{

    
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
        if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }
         $department = new Departments();

        if ($department->load(Yii::$app->request->post())) {
            if ($department->validate()) {
                // form inputs are valid, do something here
                $department->save();
                Yii::$app->session->setFlash('created', 'Department Created Successfully');
                return $this->redirect('index');
            }
        }

        return $this->render('create', [
            'department' => $department,
        ]);
    }

     public function actionDelete($id){
        if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }
        $department = Departments::find()
                    ->where(['dept_id'=>$id])
                    ->one();
        $department->delete();
        Yii::$app->session->setFlash('deleted', 'Department Deleted Successfully');
        return $this->redirect('index');
    }

    public function actionEdit($id){

        if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }

        $department = Departments::find()
                    ->where(['dept_id'=>$id])
                    ->one();

        if ($department->load(Yii::$app->request->post())) {
            if ($department->validate()) {
                // form inputs are valid, do something here
                $department->save();
                Yii::$app->session->setFlash('updated', 'Department Updated Successfully');
                return $this->redirect('index');
            }
        }

        return $this->render('edit', ['department'=>$department]);
    }

    public function actionIndex(){
        if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }
        $query = Departments::find();

        $departmentCount = $query->count();

        $pagination = new Pagination([

            'defaultPageSize'=> 5,
            'totalCount'=>$departmentCount,

        ]);

        $departments = $query
                    ->orderBy('dept_name ASC')
                    ->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();

        return $this->render('index', ['departments'=>$departments, 'pagination'=>$pagination]);
    }



    public function actionDetails($id){

        
        if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }

        $department = Departments::find()
                    ->where(['dept_id'=>$id])
                    ->one();

        return $this->render('details', ['department'=>$department]);
    }


    public function actionListDeptByFaculty($id){
        $deptsCount = Departments::find()
                ->where(['faculty_id'=>$id])
                ->count();


        $depts = Departments::find()
                ->where(['faculty_id'=>$id])
                ->all();
        if($deptsCount>0){
                // echo "<option value=''>Select Department</option>";
            foreach($depts as $dept){
                
                echo "<option value='".$dept->dept_id."'>".$dept->dept_name."</option>";
            }
        } else {
            echo "<option></option>";
        }

    }

}
