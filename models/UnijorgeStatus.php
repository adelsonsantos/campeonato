<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unijorge.status".
 *
 * @property int $status_id
 * @property string $status_ds
 */
class UnijorgeStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unijorge.status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_ds'], 'required'],
            [['status_ds'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_id' => 'Status ID',
            'status_ds' => 'Status Ds',
        ];
    }
}
