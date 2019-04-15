<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unijorge.usuario".
 *
 * @property int $usuario_id
 * @property string $usuario_nome
 * @property string $usuario_cpf
 * @property string $usuario_senha
 * @property string $usuario_foto
 * @property int $usuario_status
 */
class UnijorgeUsuario extends \yii\db\ActiveRecord
{
    public $usuario_senha_repeat;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unijorge.usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_nome', 'usuario_cpf', 'usuario_senha', 'usuario_senha_repeat'], 'required'],
            [['usuario_status'], 'integer'],
            [['usuario_nome', 'usuario_senha'], 'string', 'max' => 45, 'min' => 6],
            [['usuario_cpf'], 'string', 'max' => 18],
            [['usuario_foto'], 'string', 'max' => 255],
            ['usuario_senha', 'default', 'value' =>true],
            ['usuario_senha_repeat', 'required', 'on' => 'update'],
            ['usuario_senha_repeat', 'required', 'on' => 'create'],
            ['usuario_senha_repeat', 'compare', 'compareAttribute'=>'usuario_senha', 'skipOnEmpty' => true, 'message'=>"As senhas não correspondem"],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usuario_id' => 'ID',
            'usuario_nome' => 'Nome',
            'usuario_cpf' => 'Cpf',
            'usuario_senha' => 'Senha',
            'usuario_senha_repeat' => 'confirmar Senha',
            'usuario_foto' => 'Foto',
            'usuario_status' => 'Status',
        ];
    }
}
