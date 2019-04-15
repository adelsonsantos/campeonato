<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unijorge.formacao_tipo".
 *
 * @property int $frt_id
 * @property string $ftr_nome
 */
class UnijorgeFormacaoTipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unijorge.formacao_tipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ftr_nome'], 'required'],
            [['ftr_nome'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'frt_id' => 'Frt ID',
            'ftr_nome' => 'Ftr Nome',
        ];
    }
}
