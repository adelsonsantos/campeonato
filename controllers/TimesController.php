<?php

namespace app\controllers;

use Yii;
use app\models\Times;
use app\models\TimesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;

/**
 * TimesController implements the CRUD actions for Times model.
 */
class TimesController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Lists all Times models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Times();
        $searchModel = new TimesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,

        ]);
    }

    /**
     * Displays a single Times model.
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
     * Creates a new Times model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Times();


        if ($model->load(Yii::$app->request->post())) { $image = UploadedFile::getInstance($model, 'image');
            if (!is_null($image)) {
                $tmpfile_contents = file_get_contents($image->tempName);
                $model->time_foto = base64_encode($tmpfile_contents);
                $model->time_id = is_null($model::find()->orderBy(['time_id'=>SORT_DESC])->one()) ? 1 : $model::find()->orderBy(['time_id'=>SORT_DESC])->one()['time_id'] + 1 ;
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->time_id]);
                } else {
                    print_r($model::find()->orderBy(['time_id'=>SORT_DESC])->one());
                   // var_dump($model->getErrors());
                    die();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Times model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);



        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');
            if (!is_null($image)) {
                $tmpfile_contents = file_get_contents($image->tempName);
                $model->time_foto = base64_encode($tmpfile_contents);
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->time_id]);
                } else {
                    var_dump($model->getErrors());
                    die();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Times model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Times model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Times the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Times::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
