<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campeonato.status_jogo".
 *
 * @property int $status_jogo_id
 * @property string $status_jogo_dsc
 */
class StatusJogo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campeonato.status_jogo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_jogo_dsc'], 'required'],
            [['status_jogo_dsc'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_jogo_id' => 'Status Jogo ID',
            'status_jogo_dsc' => 'Status Jogo Dsc',
        ];
    }
}
