<?php

namespace App\Elastic\Traits\ElasticSearch;

use App\Elastic\Observer\ElasticSearchObserver;

trait ElasticSearch
{
    public static function bootElasticSearch()
    {
        if (config('elastic.enable')) {
            static::observe(ElasticSearchObserver::class);
        }
    }
    /**
     * GET MODEL INDEX
     */
    public function getIndexKey(): string
    {
        return strtolower(env('APP_NAME') . '-' . $this->getTable());
    }
    /**
     * GET MODEL TYPE 
     */
    public function getTypeKey(): string
    {
        return strtolower($this->getTable());
    }
    /**
     * GET MODEL ID
     */
    public function getId(): int
    {
        return $this->id;
    }
}
