<?php

namespace App\Elastic\Observer;

use Illuminate\Database\Eloquent\Model;

class ElasticSearchObserver
{
    public function created(Model $model)
    {
        app('elastic')->index([
            'index' => $model->getIndexKey(),
            'type' => $model->getTypeKey(),
            'id' => $model->getId(),
            'body' => $model->toArray(),
            'client' => [
                'future' => 'lazy'
            ]
        ]);
    }
    /**
     * Creating index if not exist 
     * updating Document In Elastic
     */
    public function updated(Model $model)
    {
        app('elastic')->update([
            'index' => $model->getIndexKey(),
            'type' => $model->getTypeKey(),
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
        app('elastic')->update([
            'index' => $model->getIndexKey(),
            'type' => $model->getTypeKey(),
            'id' => $model->getId(),
            'client' => [
                'future' => 'lazy'
            ]
        ]);
    }
}
