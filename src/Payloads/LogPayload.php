<?php

namespace think\Laradumps\Payloads;

class LogPayload extends Payload
{
    protected  $value;
    public function __construct(
        $value
    ) {
        $this->value = $value;
    }

    public function type(): string
    {
        return 'log';
    }

    public function content(): array
    {
        return [
            'value' => $this->value,
        ];
    }
}