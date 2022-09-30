<?php

namespace think\Laradumps\Payloads;

class DumpPayload extends Payload
{
    public  $dump;
    public  $originalContent = null;

    public function __construct(
        $dump,
        $originalContent = null
    ) {
        $this->dump            = $dump;
        $this->originalContent = $originalContent;
    }

    public function type(): string
    {
        return 'dump';
    }

    public function content(): array
    {
        return [
            'dump'            => $this->dump,
            'originalContent' => $this->originalContent,
        ];
    }
}