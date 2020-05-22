<?php

namespace app\models;

class TelegramProvider extends AbstractProvider
{
    const ID = 'Telegram';
    const TITLE = 'Telegram';

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
