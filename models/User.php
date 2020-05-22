<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    const SCENARIO_UPDATE = 'update';

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Find an identity by given username.
     * @param string $username username to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->passwd);
    }

    /**
     * Additional functional for new records: generate auth_key.
     *
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        $parentResult = parent::beforeSave($insert);
        if (!$parentResult) {
            return $parentResult;
        }

        if (
            $this->passwd
            && in_array('passwd', $this->scenarios()[$this->getScenario()])
        ) {
            $this->passwd = Yii::$app->getSecurity()->generatePasswordHash($this->passwd);
        }

        if (!$this->isNewRecord) {
            return true;
        }

        do {
            $this->auth_key = Yii::$app->security->generateRandomString();
        } while (self::find()->where(['auth_key' => $this->auth_key])->asArray()->one());

        return true;
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_UPDATE] = ['email'];
        return $scenarios;
    }

    public function rules()
    {
        return [
            [['username', 'passwd', 'email'], 'trim'],
            [['username', 'passwd', 'email'], 'required'],
            ['username', 'string', 'max' => 30],
            ['email', 'string', 'max' => 60],
            ['email', 'email'],
            [['username', 'email'], 'unique'],
        ];
    }
}
