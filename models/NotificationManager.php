<?php

namespace app\models;

use yii\base\Exception;

class NotificationManager
{
    protected $providers;
    protected $errors;

    public function addProvider(ProviderInterface $provider): self
    {
        if (isset($this->providers[$provider->getId()])) {
            throw new Exception(sprintf('Provider ID %s is already added.', $provider->getId()));
        }
        $this->providers[$provider->getId()] = $provider;
        return $this;
    }

    public function send(
        string $name,
        string $recipient,
        string $title,
        string $body
    ): bool
    {
        foreach ($this->providers as $provider) {
            if (!$provider->send($recipient, $recipient, $title, $body)) {
                $this->addError($provider);
            }
        }
        return !$this->hasErrors();
    }

    public function addError(ProviderInterface $provider): self
    {
        $this->errors[$provider->getId()] = array_merge(
            $this->errors[$provider->getId()] ?? [],
            $provider->getErrors()
        );
        return $this;
    }
    
    public function getErrors(): array
    {
        return $this->errors ?? [];
    }
    
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }
}
