<?php

namespace app\models;

abstract class AbstractProvider implements ProviderInterface
{
    protected $errors;
    
    protected function addError(string $errMsg): self
    {
        $this->errors[] = $errMsg;
        return $this;
    }
    
    public function getErrors(): array
    {
        return $this->errors ?? [];
    }
}
