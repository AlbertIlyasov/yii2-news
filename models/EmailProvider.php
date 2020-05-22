<?php

namespace app\models;

use Yii;

class EmailProvider extends AbstractProvider
{
    const ID = 'Email';
    const TITLE = 'Email';

    public function getId(): string
    {
        return self::ID;
    }
    
    public function getTitle(): string
    {
        return self::TITLE;
    }

    public function send(
        string $name,
        string $recipient,
        string $title,
        string $body
    ): bool
    {
//        echo __METHOD__ . ' sending notification';
        return true;
    }
}
