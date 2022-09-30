<?php

namespace think\Laradumps\Payloads;

class TimeTrackPayload extends Payload
{
     public $reference;

    /**
     * Clock script executiontime
     *
     * @param string $reference Reference name used in each call
     */
    public function __construct(
        $reference
    ) {
        $this->reference = $reference;
    }

    public function type(): string
    {
        return 'time-track';
    }

    /** @return array<string, mixed> */
    public function content(): array
    {
        return [
            'timeTrackerId' => base64_encode(config('app.name') . strtolower($this->reference)),
            'label'         => $this->reference,
            'time'          => microtime(true),
        ];
    }
}