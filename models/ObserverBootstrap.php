<?php

namespace app\models;

use yii\base\BootstrapInterface;
use yii\base\Event;

class ObserverBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $this->registerObservers();
    }
    
    private function registerObservers()
    {
        $notification = function($e) {
            if (!$e->changedAttributes) {
                return;
            }
            $user = $e->sender;
//            @todo: $typeId = $e->name -> int;
            $typeId = 1;
            $user->sendNotification($typeId);
        };
        Event::on(User::class, User::EVENT_AFTER_UPDATE, $notification);
    }
}
