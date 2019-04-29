<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "campeonato.jogos".
 *
 * @property int $jogo_id
 * @property int $time_id_casa
 * @property int $placar_casa
 * @property int $time_id_visitante
 * @property int $placar_visitante
 * @property int $jogo_turno
 * @property int $status_jogo
 * @property int $temporada
 * @property string $jogo_data
 */
class Jogos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campeonato.jogos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jogo_id'], 'required'],
            [['jogo_id', 'time_id_casa', 'placar_casa', 'time_id_visitante', 'placar_visitante', 'temporada', 'jogo_turno', 'status_jogo'], 'integer'],
            [['jogo_id'], 'unique'],
            ['jogo_data', 'datetime', 'format' => 'Y-m-d H:i:s'],
            [['status_jogo'], 'exist', 'skipOnError' => true, 'targetClass' => StatusJogo::className(), 'targetAttribute' => ['status_jogo' => 'status_jogo_id']],
            [['time_id_casa'], 'exist', 'skipOnError' => true, 'targetClass' => Times::className(), 'targetAttribute' => ['time_id_casa' => 'time_id']],
            [['time_id_visitante'], 'exist', 'skipOnError' => true, 'targetClass' => Times::className(), 'targetAttribute' => ['time_id_visitante' => 'time_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jogo_id' => 'Jogo ID',
            'time_id_casa' => 'Casa',
            'placar_casa' => 'Placar Casa',
            'time_id_visitante' => 'Visitante',
            'placar_visitante' => 'Placar Visitante',
            'jogo_turno' => 'Turno',
            'jogo_data' => 'data',
            'status_jogo' => 'Status',
            'temporada' => 'temporada',
        ];
    }

    public function getTimecasa()
    {
        return $this->hasOne(Times::className(), ['time_id' => 'time_id_casa']);
    }

    public function getTimevisitante()
    {
        return $this->hasOne(Times::className(), ['time_id' => 'time_id_visitante']);
    }

    public function getStatus()
    {
        return $this->hasOne(StatusJogo::className(), ['status_jogo_id' => 'status_jogo']);
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'jogo_data',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'jogo_data',
                ],
                'value' => function() {
                    return date('Y-m-d H:i:s');
                },
            ],
        ];
    }
}

$ultimosJogos = [
    0 => ['label' =>'Abelha Pikadora 2 x 0 Vasco', 'cor' => 'green']
];
