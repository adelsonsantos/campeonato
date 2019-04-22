<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campeonato.times".
 *
 * @property int $time_id
 * @property string $time_nome
 * @property string $time_foto
 * @property int $time_status
 */
class Times extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campeonato.times';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time_id', 'time_nome'], 'required'],
            [['time_id', 'time_status'], 'integer'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
            [['image'], 'file', 'maxSize'=>'100000'],
            [['time_foto'], 'string'],
            [['time_nome'], 'string', 'max' => 50],
            [['time_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'time_id' => 'Time ID',
            'time_nome' => 'Time Nome',
            'time_foto' => 'Time Foto',
            'time_status' => 'Time Status',
            'image' => 'image'
        ];
    }
}
