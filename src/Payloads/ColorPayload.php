<?php

namespace think\Laradumps\Payloads;

class ColorPayload extends Payload
{
    public $color;
    public function __construct(
        string $color
    ) {
        $this->color = $color;
    }

    public function type(): string
    {
        return 'color';
    }

    /** @return array<string> */
    public function content(): array
    {
        return [
            'color' => $this->color,
        ];
    }
}