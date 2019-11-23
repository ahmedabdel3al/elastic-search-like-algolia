<?php

namespace App;

use App\Elastic\Traits\ElasticSearch\ElasticSearch;
use App\Filter\FieldInterface;
use App\Filter\Filter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model implements FieldInterface
{
    use Filter;
    //use ElasticSearch;
    protected $fillable = ['title', 'body'];
    public function user()
    {
        return $this->BelongsTo(User::class);
    }
    public function fields(): array
    {
        return [
            'title' => 'like',
            'body' => 'like',
            'users-name' => ['opration' => 'like', 'forgin_key' => 'user_id'],

        ];
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
