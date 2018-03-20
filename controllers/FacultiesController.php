<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Faculties;

use yii\data\Pagination;

class FacultiesController extends \yii\web\Controller {


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

        $faculty = new Faculties();

        if ($faculty->load(Yii::$app->request->post())) {
            if ($faculty->validate()) {
                $faculty->save();
                Yii::$app->session->setFlash('created', 'Faculty Created Successfully');
                return $this->redirect('index');
            }
        }

        return $this->render('create', [
            'faculty' => $faculty,
    ]);

    }

    public function actionDelete($id){

        if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }

        $faculty = Faculties::find()
                    ->where(['faculty_id'=>$id])
                    ->one();
        $faculty->delete();
        Yii::$app->session->setFlash('deleted', 'Faculty Deleted Successfully');
        return $this->redirect('index');
    }

    public function actionEdit($id){

        if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }

        $faculty = Faculties::find()
                    ->where(['faculty_id'=>$id])
                    ->one();

        if ($faculty->load(Yii::$app->request->post())) {
            if ($faculty->validate()) {
                $faculty->save();
                Yii::$app->session->setFlash('updated', 'Faculty Updated Successfully');
                return $this->redirect('index');
            }
        }

            return $this->render('edit', [
                'faculty' => $faculty,
        ]);
    }

    public function actionDetails($id){

        if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }

        $faculty = Faculties::find()
                    ->where(['faculty_id'=>$id])
                    ->one();

        return $this->render('details', ['faculty'=>$faculty]);
    }

    public function actionIndex(){

        if(Yii::$app->user->identity->role !=='admin'){
            return $this->redirect('../site/index');
        }
        
        $query = Faculties::find();

        $facultiesCount = $query->count();

        $pagination = new Pagination([

            'defaultPageSize'=> 20,
            'totalCount'=>$facultiesCount,

        ]);

        $faculties = $query
                    ->orderBy('faculty_name ASC')
                    ->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();

        return $this->render('index', ['faculties'=>$faculties, 'pagination'=>$pagination]);
    }

}
