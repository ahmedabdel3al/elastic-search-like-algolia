<?php

namespace App\Elastic\Observer;

use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Model;

class ElasticSearchObserver
{
    protected $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function created(Model $model)
    {
        if (!$this->setIndexIfNotExist($model->getIndexKey())) {
            $this->setIndexMapping($model);
        }
        $this->client->index([
            'index' => $model->getIndexKey(),
            'id' => $model->getId(),
            'body' => $model->toArray(),
        ]);
    }
    /**
     * check if index exist or not 
     */
    protected function setIndexIfNotExist($index): bool
    {
        return  $this->client->indices()->exists(['index' => $index]);
    }
    /**
     * set mapping 
     */
    protected function setIndexMapping($model)
    {
        return $this->client->indices()->create($model->getElaticMapping());
    }
    /**
     * Creating index if not exist 
     * updating Document In Elastic
     */
    public function updated(Model $model)
    {
        $this->client->update([
            'index' => $model->getIndexKey(),
            'id' => $model->getId(),
            'body' => $model->toArray(),
            'client' => [
                'future' => 'lazy'
            ]
        ]);
    }
    /**
     * Creating index if not exist 
     * deleteing Document In Elastic
     */
    public  function deleted(Model $model)
    {
        $this->client->update([
            'index' => $model->getIndexKey(),
            'id' => $model->getId(),
            'client' => [
                'future' => 'lazy'
            ]
        ]);
    }
}
