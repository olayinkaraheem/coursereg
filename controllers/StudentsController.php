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

class StudentsController extends \yii\web\Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        $new_student = new Students();

        if ($new_student->load(Yii::$app->request->post())) {
            if ($new_student->validate()) {
                // form inputs are valid, do something here

                $new_student->save();

                Yii::$app->session->setFlash('Reg_Success', 'Registration Successful');

                return $this->redirect('index');
            }
        }

        return $this->render('signup', [
            'new_student' => $new_student,
        ]);
    }

}
