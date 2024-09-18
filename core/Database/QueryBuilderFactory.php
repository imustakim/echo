<?php

namespace Core\Database;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Builder as QueryBuilder;

class QueryBuilderFactory {

    /**
     * @var Capsule
     */
    protected $capsule;

    /**
     * QueryBuilderFactory constructor.
     * 
     * @param Capsule $capsule
     */
    public function __construct(Capsule $capsule) {
        $this->capsule = $capsule;
    }

    /**
     * Get a new query builder instance for the given table.
     *
     * @param string $table
     * @return QueryBuilder
     */
    public function table(string $table): QueryBuilder {
        return $this->capsule->table($table);
    }

    /**
     * Run a raw SQL query.
     *
     * @param string $query
     * @param array $bindings
     * @return array
     */
    public function rawQuery(string $query, array $bindings = []): array {
        return $this->capsule->getConnection()->select($query, $bindings);
    }
}
