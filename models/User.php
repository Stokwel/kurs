<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $first_name
 * @property string $second_name
 * @property string $third_name
 * @property string $address_residence
 * @property string $place_work
 * @property integer $birth_date
 * @property integer $role
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne(['password_reset_token' => $token]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function isEmployee()
    {
        return $this->is_employee;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return true;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return md5($password.$this->salt) === $this->password;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPasswordAndSalt($password)
    {
        $this->salt = $this->generateSalt();
        $this->password = $this->getPassword($password, $this->salt);
    }

    public function getPassword($password, $salt)
    {
        return md5($password.$salt);
    }

    public function generateSalt()
    {
        $cost = 13;
        $rand = Yii::$app->security->generateRandomKey(20);
        $salt = sprintf("$2y$%02d$", $cost);
        $salt .= str_replace('+', '.', substr(base64_encode($rand), 0, 22));

        return $salt;
    }

    public static function getAuthors()
    {
        return self::find()->where(['role' => 0]);
    }

    public static function getUsersList()
    {
        return self::find()->select(['CONCAT([[second_name]]," ",[[first_name]])', 'id'])->indexBy('id')->where(['role' => 0])->column();
    }

    public static function getCollaborationsList($userId)
    {
        return self::find()->select(['CONCAT([[second_name]]," ",[[first_name]])', 'id'])->indexBy('id')->where(['role' => 0])->andWhere('id != ' . $userId)->column();
    }
}