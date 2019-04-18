<?php

namespace app\controllers;

use app\models\Tabela;
use app\models\Times;
use Yii;
use app\models\Jogos;
use app\models\JogosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JogosController implements the CRUD actions for Jogos model.
 */
class JogosController extends Controller
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
     * Lists all Jogos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JogosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Jogos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function atualizaTabela($model){
        $modelTabela = new Tabela();
        $timeDaCasa = null;
        $timeVisitante = null;

        if($model->status_jogo == 2){

            if($model->placar_casa > $model->placar_visitante){
                $pontosTimeCasa = 3;
                $pontosVisitante = 0;

                $vitTimeCasa = 1;
                $vitVisitante = 0;

                $empTimeCasa = 0;
                $empVisitante = 0;

                $derTimeCasa = 0;
                $derVisitante = 1;
            }elseif($model->placar_casa == $model->placar_visitante){
                $pontosTimeCasa = 1;
                $pontosVisitante = 1;

                $vitTimeCasa = 0;
                $vitVisitante = 0;

                $empTimeCasa = 1;
                $empVisitante = 1;

                $derTimeCasa = 0;
                $derVisitante = 0;
            }else{
                $pontosTimeCasa = 0;
                $pontosVisitante = 3;

                $vitTimeCasa = 0;
                $vitVisitante = 1;

                $empTimeCasa = 0;
                $empVisitante = 0;

                $derTimeCasa = 1;
                $derVisitante = 0;
            }
            $modelTabelaDaCasa = Tabela::findOne($modelTabela::find()->where(['time_id'=> $model->time_id_casa])->andWhere(['temporada'=> 2])->asArray()->all()[0]['tabela_id']);
            $modelTabelaVisitante = Tabela::findOne($modelTabela::find()->where(['time_id'=> $model->time_id_visitante])->andWhere(['temporada'=> 2])->asArray()->all()[0]['tabela_id']);

            // TIME DA CASA
            $modelTabelaDaCasa->time_pontos = $modelTabelaDaCasa->time_pontos + $pontosTimeCasa;
            $modelTabelaDaCasa->time_partidas_jogadas = $modelTabelaDaCasa->time_partidas_jogadas + 1;
            $modelTabelaDaCasa->time_vitorias = $modelTabelaDaCasa->time_vitorias + $vitTimeCasa;
            $modelTabelaDaCasa->time_derrotas = $modelTabelaDaCasa->time_derrotas + $derTimeCasa;
            $modelTabelaDaCasa->time_empates = $modelTabelaDaCasa->time_empates + $empTimeCasa;
            $modelTabelaDaCasa->time_gols_marcados = $modelTabelaDaCasa->time_gols_marcados + $model->placar_casa;
            $modelTabelaDaCasa->time_gols_sofridos = $modelTabelaDaCasa->time_gols_sofridos + $model->placar_visitante;
            $modelTabelaDaCasa->time_gols_saldo = $modelTabelaDaCasa->time_gols_marcados - $modelTabelaDaCasa->time_gols_sofridos;


            //TIME VISITANTE
            $modelTabelaVisitante->time_pontos = $modelTabelaVisitante->time_pontos + $pontosVisitante;
            $modelTabelaVisitante->time_partidas_jogadas = $modelTabelaVisitante->time_partidas_jogadas + 1;
            $modelTabelaVisitante->time_vitorias = $modelTabelaVisitante->time_vitorias + $vitVisitante;
            $modelTabelaVisitante->time_derrotas = $modelTabelaVisitante->time_derrotas + $derVisitante;
            $modelTabelaVisitante->time_empates = $modelTabelaVisitante->time_empates + $empVisitante;
            $modelTabelaVisitante->time_gols_marcados = $modelTabelaVisitante->time_gols_marcados + $model->placar_visitante;
            $modelTabelaVisitante->time_gols_sofridos = $modelTabelaVisitante->time_gols_sofridos + $model->placar_casa;
            $modelTabelaVisitante->time_gols_saldo = $modelTabelaVisitante->time_gols_marcados - $modelTabelaVisitante->time_gols_sofridos;



            $modelTabelaDaCasa->save();
            $modelTabelaVisitante->save();
        }

    }

    public function actionEliminatoria(){
        return $this->render('eliminatoria', []);
    }

    /**
     * Creates a new Jogos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Jogos();


        if ($model->load(Yii::$app->request->post()) && ($model->time_id_visitante != $model->time_id_casa)) {
            $model->jogo_id = is_null($model::find()->orderBy(['jogo_id'=>SORT_DESC])->one()) ? 1 : $model::find()->orderBy(['jogo_id'=>SORT_DESC])->one()['jogo_id'] + 1 ;

           $this->atualizaTabela($model);
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionCriarMultiplosJogos(){
        $model  = new Jogos();
        $timeAtual = 2;

        $timeAdversario = Times::find()->where(['not in','time_id',[1]])->andWhere(['time_status' => 0])->asArray()->all();
        foreach ($timeAdversario as $key){


            $qtdJogo = Jogos::find()->where(['not in','time_id_visitante',[1]])
                                    ->andWhere(['not in','time_id_casa',[1]])
                                    ->andWhere(['temporada' => 2])
                                    ->all();

            echo "<pre>";
            print_r($key);
            die();
            if($qtdJogo == 0){
                $model->jogo_id = $model->jogo_id = is_null($model::find()->orderBy(['jogo_id'=>SORT_DESC])->one()) ? 1 : $model::find()->orderBy(['jogo_id'=>SORT_DESC])->one()['jogo_id'] + 1 ;
                $model->time_id_visitante = $key['time_id'];

                //time
                $model->time_id_casa = $timeAtual;

                $model->status_jogo = 1;
                $model->jogo_turno = 1;
                $model->temporada = 2;
                echo "<pre>";
                print_r($model);
              //  $model->save();
            }





        }





        return $this->render('multiplos-jogos');
    }

    /**
     * Updates an existing Jogos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $this->atualizaTabela($model);
            $model->save();
            return $this->redirect(['view', 'id' => $model->jogo_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Jogos model.
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
     * Finds the Jogos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jogos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jogos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
