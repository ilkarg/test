<?php

    namespace app\controllers;

    use yii\web\Controller;
    use yii\helpers\Url;

    class PageController extends Controller
    {
        public function actionTest()
        {
            return $this->renderFile('@app/views/site/test.html');
        }
    }