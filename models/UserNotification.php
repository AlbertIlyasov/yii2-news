<?php

namespace app\models;

use yii\db\ActiveRecord;

class UserNotification extends ActiveRecord
{
    public function getNotificationType()
    {
        return $this->hasOne(NotificationType::class, ['id' => 'notification_type_id']);
    }
}
