<?php

namespace think\Laradumps\Payloads;

class DiffPayload extends Payload
{
    public mixed $argument;
    public bool $splitDiff;

    public function __construct(
        mixed $argument,
        bool $splitDiff
    ) {
        $this->argument  = $argument;
        $this->splitDiff = $splitDiff;
    }

    public function type(): string
    {
        return 'diff';
    }

    /** @return array<string, mixed> */
    public function content(): array
    {
        return [
            'argument'  => $this->argument,
            'splitDiff' => $this->splitDiff,
        ];
    }
}