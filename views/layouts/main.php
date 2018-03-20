<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<script type="text/javascript">var selectedDept = [];</script>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'CourseReg <sup>&reg;</sup>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            // ['label' => 'Signup', 'url' => ['/students/signup'], 'visible'=>Yii::$app->user->isGuest],
            ['label' => 'Register Courses', 'url' => ['/registration/index'], 'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'student'],
            ['label' => 'Courses', 'url' => ['/courses/index'], 'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'admin'],
            ['label' => 'Faculties', 'url' => ['/faculties/index'], 'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'admin'],
            ['label' => 'Departments', 'url' => ['/departments/index'], 'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'admin'],
            ['label' => 'Admin', 'url' => ['/site/login'], 'visible'=>Yii::$app->user->isGuest],
            ['label' => 'Registrations', 'url' => ['/registration/pending'], 'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'admin'],
            Yii::$app->user->isGuest ? (
                ['label' => 'Student Login', 'url' => ['/students/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; CourseReg <sup>&reg;</sup> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>

<script type="text/javascript">
    // $(document).ready(function(){
    //     $('#add').bind('click', function(e){
    //         e.preventDefault();
    //         alert($('#add_input').val);
    //     })
    // })
    $(document).ready(function(){
        var url = window.location.href; var bgImg;
        if(url.includes('site/index')){
            bgImg = '../../web/images/bg1.jpg';
            // $('p.links a:first').attr('href','../students/signup');
            $('p.links a:last').attr('href','../students/login');
        } else {
            bgImg = './images/bg1.jpg';
        }
        $('.site-index').parents('div.container').removeClass('container').css({'backgroundImage':'url("'+bgImg+'")','backgroundSize':'cover','height':'690px','paddingTop':'10em'});

        $('#add-course-btn').bind('click', AddCourse);

        function AddCourse(e){
            e.preventDefault();
            $('.course-input:last').clone().insertAfter('.course-input:last');
        }

        $('.alert').css({
            'width':'0',
            'margin-left':'-50px',
            'opacity':'0'
        }).animate({
            'width':'100%',
            'margin-left':'0',
            'opacity':'1'
        },
        {
            'duration':'5000',
            'easing':'swing'
        },
        {'specialEasing':{
            'width':'linear'
        }});

        $('select[name=faculty_id], select[name=dept_id]').addClass('form-control').css({'magin-bottom':'20px'});
    })

</script>

</body>
</html>
<?php $this->endPage() ?>
