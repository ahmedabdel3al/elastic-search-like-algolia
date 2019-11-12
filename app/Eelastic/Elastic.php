<?php

namespace App\Elastic;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class Elastic
{
    public function search($key, Model $model)
    {

        $search =   app('elastic')->search([
            'index' => $model->getIndexKey(),
            'type' => $model->getTypeKey(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['title^5', 'body'],
                        'query' => $key,
                    ],
                ],
            ],
        ]);
        return $this->prepareDataAfterSearch($search);
    }
    protected function prepareDataAfterSearch($search)
    {
        return array_column($search['hits']['hits'], '_source');
    }
}
