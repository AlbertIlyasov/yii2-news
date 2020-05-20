<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $descr
 * @property timestamp $created_at
 * @property datetime $updated_at
 */
class News extends ActiveRecord
{
    public function rules()
    {
        return [
            [['title', 'descr'], 'trim'],
            [['title', 'descr'], 'required'],
        ];
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $this->user_id = Yii::$app->user->identity->id;
        return parent::save($runValidation, $attributeNames);
    }
}
