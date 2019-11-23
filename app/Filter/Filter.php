<?php

namespace App\Filter;

use Doctrine\Common\Inflector\Inflector;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Psy\Util\Str;

trait Filter
{
    public function scopeSearch(Builder $builder, Request $request)
    {

        foreach (array_keys($this->fields()) as $value) {
            $feildWithDatabaseName = explode('-', $value);
            if (count($feildWithDatabaseName) == 2) {
                $className = Inflector::singularize($feildWithDatabaseName[0]);
                $class = "App\\" . ucwords($className);
                $builder->join($feildWithDatabaseName[0], $this->getTable() . '.' . $className . '_' . (new $class)->getKeyName(), "$feildWithDatabaseName[0]." . $this->getKeyName());
            }
        }
    }
}
