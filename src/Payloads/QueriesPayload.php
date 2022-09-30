<?php

namespace think\Laradumps\Payloads;

class QueriesPayload extends Payload
{
    private $queries = [];
    public $file     = '';
    public $line     = '';
    public $trace    = [];

    public function __construct(
        $queries = [],
        $file    = '',
        $line    = '',
        $trace   = []
    ) {
        $this->queries = $queries;
        $this->file    = $file;
        $this->line    = $line;
        $this->trace   = $trace;
    }

    public function type(): string
    {
        return 'queries';
    }

    public function content(): array
    {
        return [
            'queries' => $this->queries,
            'file'    => $this->file,
            'line'    => $this->line,
        ];
    }
}