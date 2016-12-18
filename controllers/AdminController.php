<?php

namespace app\controllers;

use app\models\Articles;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionArticleDelete($id)
    {
        $article = Articles::findOne($id);
        $article->deleted = $article->deleted ? 0 : 1;
        $article->save();

        return  Yii::$app->response->redirect(Url::to(['site/articles']));
    }
}
