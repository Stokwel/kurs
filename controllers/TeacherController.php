<?php

namespace app\controllers;

use app\models\Works;
use app\models\WorksSearch;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

class TeacherController extends Controller
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
                        'roles' => ['teacher'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionWorks()
    {
        $searchModel = new WorksSearch();
        $params = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($params);

        return $this->render('works', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRating($id)
    {
        $model = Works::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['works']);
        } else {
            return $this->render('rating', [
                'model' => $model
            ]);
        }
    }
}
