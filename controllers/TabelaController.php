<?php

namespace app\controllers;

use app\models\Times;
use Yii;
use app\models\Tabela;
use app\models\TabelaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TabelaController implements the CRUD actions for Tabela model.
 */
class TabelaController extends Controller
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
        ];
    }

    /**
     * Lists all Tabela models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TabelaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tabela model.
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
     * Creates a new Tabela model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tabela();


        $times = Times::find()->where(['time_status' => 0])->asArray()->all();
        echo "<pre>";
        //print_r($times);
        foreach ($times as $key){
            $model = new Tabela();
            $model->tabela_id = $model::find()->orderBy(['tabela_id'=>SORT_DESC])->one()['tabela_id'] + 1;
            $model->time_id = $key['time_id'];
            $model->time_pontos = 0;
            $model->time_partidas_jogadas = 0;
            $model->time_vitorias = 0;
            $model->time_empates = 0;
            $model->time_derrotas = 0;
            $model->time_gols_marcados = 0;
            $model->time_gols_sofridos = 0;
            $model->time_gols_saldo = 0;
            $model->tabela_turno = 0;
            $model->status = 0;
            $model->temporada = 2;
         //   $model->save();
        }

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->tabela_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tabela model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->tabela_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tabela model.
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
     * Finds the Tabela model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tabela the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tabela::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
