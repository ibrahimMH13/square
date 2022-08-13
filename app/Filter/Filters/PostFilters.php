<?php


namespace App\Filter\Filters;


use App\Filter\FiltersAbstract;
use App\Filter\FiltersType\OrderByFilter;

class PostFilters extends FiltersAbstract
{
    protected $filters =[
        'show' => OrderByFilter::class,
    ];

}
