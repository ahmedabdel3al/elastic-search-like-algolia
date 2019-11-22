<?php

namespace App;

use App\Elastic\Traits\ElasticSearch\ElasticSearch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    //use ElasticSearch;
    protected $fillable = ['title', 'body'];
    public function user()
    {
        return $this->BelongsTo(User::class);
    }
    public function getElaticMapping()
    {
        return [
            'index' => $this->getIndexKey(),
            'body' => [
                'mappings' => [
                    'properties' => [
                        'id' => ['type' => 'long'],
                        'title' => ['type' => 'text', 'fields' => ['keyword' => ['type' => 'keyword']]],
                        'body' => ['type' => 'text', 'fields' => ['keyword' => ['type' => 'keyword']]],
                        'created_at' => ['type' => 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'],
                        'updated_at' => ['type' => 'date', 'format' => 'yyyy-MM-dd HH:mm:ss']
                    ]
                ]
            ]
        ];
    }
}
