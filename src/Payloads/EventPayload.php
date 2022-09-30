<?php

namespace think\Laradumps\Payloads;

class EventPayload extends Payload
{
    /** @var object|mixed|null */
    protected $event = null;

    public function __construct($eventName, $payload)
    {
        if (class_exists($eventName)) {
            $this->event = $payload[0];
        }
        $this->payload = $payload;
    }

    public function content(): array
    {
        return [
            'name'              => $this->eventName,
            'event'             => $this->event ?: null,
            'payload'           => count($this->payload) ? $this->payload : null,
            'class_based_event' => !is_null($this->event),
        ];
    }

    public function type(): string
    {
        return 'events';
    }
}