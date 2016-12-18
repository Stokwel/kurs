<?php

namespace app\controllers;

use app\models\ArticlesSearch;
use app\models\Collaboration;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\SignupForm;

class SiteController extends Controller
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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isAdmin()) {
            return  Yii::$app->response->redirect(Yii::$app->user->getHomeUrl());
        }

        $collaboration = [];
        if (Yii::$app->user->id) {
            $collaboration = Collaboration::getNonConfirmed(Yii::$app->user->id);
        }

        return $this->render('index', [
            'countCollaboration' => count($collaboration)
        ]);
    }

    public function actionArticles()
    {
        $searchModel = new ArticlesSearch();
        $params = Yii::$app->request->queryParams;
        if (!Yii::$app->user->isAdmin()) {
            $params['ArticlesSearch']['deleted'] = 0;
        }
        $dataProvider = $searchModel->search($params);

        return $this->render('articles', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAuthors()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::getAuthors(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('authors', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return  Yii::$app->response->redirect(Yii::$app->user->getHomeUrl());
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}
