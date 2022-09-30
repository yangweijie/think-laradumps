<?php

namespace think\Laradumps\Payloads;

use Illuminate\Database\Query\Builder;

class QueryPayload extends Payload
{
    protected $query;
    public function __construct(
        $query
    ) {
        $this->query = $query;
    }

    public function content(): array
    {
        $toSql = str_replace(['?'], ['\'%s\''], $this->query->toSql());
        $toSql = vsprintf($toSql, $this->query->getBindings());

        return [
            'sql' => $toSql,
        ];
    }

    public function type(): string
    {
        return 'query';
    }
}