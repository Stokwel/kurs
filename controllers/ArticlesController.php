<?php

namespace app\controllers;

use app\models\Articles;
use app\models\ArticlesSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ArticlesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
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

    /**
     * Lists all Works models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticlesSearch();

        $params = Yii::$app->request->queryParams;
        $params['ArticlesSearch']['user_id'] = Yii::$app->user->getId();
        $params['ArticlesSearch']['confirmed'] = 1;
        
        $dataProvider = $searchModel->search($params);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionNonConfirmed()
    {
        $searchModel = new ArticlesSearch();

        $params = Yii::$app->request->queryParams;
        $params['ArticlesSearch']['user_id'] = Yii::$app->user->getId();
        $params['ArticlesSearch']['confirmed'] = 0;
        $params['ArticlesSearch']['deleted'] = 0;

        $dataProvider = $searchModel->search($params);

        return $this->render('non-confirmed', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Works model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Works model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Articles();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'userId' => Yii::$app->user->getId()
            ]);
        }
    }

    /**
     * Updates an existing Works model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->user_id != Yii::$app->user->id) {
            return $this->goBack();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'userId' => Yii::$app->user->getId()
            ]);
        }
    }

    /**
     * Deletes an existing Articles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->user_id != Yii::$app->user->id) {
            return $this->goBack();
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Works model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Works the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Articles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
