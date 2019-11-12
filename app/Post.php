<?php

namespace App;

use App\Elastic\Traits\ElasticSearch\ElasticSearch;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use ElasticSearch;
    protected $fillable = ['title', 'body'];
}
