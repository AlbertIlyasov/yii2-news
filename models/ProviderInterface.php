<?php

namespace app\models;

interface ProviderInterface
{
    public function getId(): string;
    public function getTitle(): string;
    public function send(
        string $name,
        string $recipient,
        string $title,
        string $body
    ): bool;
    public function getErrors(): array;
}
