<?php

namespace app\models;
use Yii;
use yii\base\Security;
use yii\db\ActiveRecord;
use yii\base\NotSupportedException;
//use yii\helpers\Security;
use yii\web\IdentityInterface;


/**
 * This is the model class for table "tbl_user".
 *
 * @property integer $pessoa_id
 * @property string  $usuario_cpf
 * @property string  $usuario_senha

 */

class User extends ActiveRecord implements IdentityInterface
{
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
            [['usuario_id', 'usuario_nome', 'usuario_login', 'usuario_status', 'usuario_senha'], 'required', 'message'=>'{attribute} não pode ficar em branco.'],
            [['usuario_login', 'usuario_senha','usuario_nome' ], 'string', 'max' => 100]
        ];
    }
    /**
     * @inheritdoc
     */

    public function attributeLabels()
    {
        return [
            'usuario_id' => 'usuario_id',
            'usuario_login' => 'Login',
            'usuario_senha' => 'Senha',
            'usuario_nome' => 'Nome',
            'usuario_status' => 'Status'
        ];
    }



    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    /* modified */

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /* removed
        public static function findIdentityByAccessToken($token)
        {
            throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');

        }

    */
    /**
     * Finds user by username
     *
     * @param  string      $usuario_login
     * @return static|null
     */
    public static function findByUsername($usuario_login)
    {
        return static::findOne(['usuario_login' => $usuario_login]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];

        $parts = explode('_', $token);

        $timestamp = (int) end($parts);

        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        //  return $this->auth_key;
    }

    /**
     * @inheritdoc
     */

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $usuario_senha password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($usuario_senha)
    {
        return $this->usuario_senha === sha1($usuario_senha);
    }

//    /**
//     * Generates password hash from password and sets it to the model
//     *
//     * @param string $password
//     */
//    public function setPassword($usuario_senha)
//    {
//        $this->password_hash = Security::generatePasswordHash($usuario_senha);
//    }


//    /**
//     * Generates "remember me" authentication key
//     */
//    public function generateAuthKey()
//    {
//        $this->auth_key = Security::generateRandomKey();
//    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /** EXTENSION MOVIE **/

}
