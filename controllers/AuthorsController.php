<?php

namespace app\controllers;

use app\models\Collaboration;
use app\models\Works;
use app\models\WorksSearch;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

class AuthorsController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['author'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $user = Yii::$app->getUser()->getIdentity();

        $collaboration = Collaboration::getNonConfirmed(Yii::$app->user->id);

        return $this->render('index', [
            'user' => $user,
            'countCollaboration' => count($collaboration)
        ]);
    }

    public function actionConfirm($id)
    {
        $collaboration = Collaboration::findOne(['article_id' => $id, 'user_id' => Yii::$app->user->id]);
        $collaboration->confirmed = 1;
        $collaboration->save();

        return  Yii::$app->response->redirect(Url::to(['authors/index']));
    }
}
