<?php


namespace App\Filter\Contract;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

interface IFilter
{
    public function filter(Builder $builder,$value);

}
