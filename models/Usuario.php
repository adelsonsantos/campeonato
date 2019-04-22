<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campeonato.usuario".
 *
 * @property int $usuario_id
 * @property string $usuario_nome
 * @property int $usuario_status
 * @property string $usuario_login
 * @property string $usuario_senha
 * @property string $usuario_foto
 * @property int $time_id
 * @property int $usuario_permissao
 * @property int $usuario_acesso
 */
class Usuario extends \yii\db\ActiveRecord
{
    public $usuario_senha_repeat;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campeonato.usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_nome', 'usuario_login', 'usuario_senha'], 'required'],
            [['usuario_status', 'time_id', 'usuario_permissao'], 'integer'],
            [['usuario_senha', 'usuario_foto', 'usuario_acesso'], 'string'],
            [['usuario_nome'], 'string', 'max' => 45],
            [['usuario_login'], 'string', 'max' => 50],
            [['time_id'], 'exist', 'skipOnError' => true, 'targetClass' => Times::className(), 'targetAttribute' => ['time_id' => 'time_id']],
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
            'usuario_id' => 'Usuario ID',
            'usuario_nome' => 'Usuario Nome',
            'usuario_status' => 'Usuario Status',
            'usuario_login' => 'Usuario Login',
            'usuario_senha' => 'Usuario Senha',
            'usuario_senha_repeat' => 'confirmar Senha',
            'usuario_foto' => 'Usuario Foto',
            'usuario_acesso' => 'Acesso',
            'time_id' => 'Time ID',
            'usuario_permissao' => 'Permissão',
        ];
    }
}
