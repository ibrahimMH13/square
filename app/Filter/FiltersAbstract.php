<?php


namespace App\Filter;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class FiltersAbstract
{
    /**
     * @var Request
     */
    private $request;
    protected $filters = [];
    protected $defaultFilter =[
        'show' =>'newest'
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function filter(Builder $builder)
    {
        foreach ($this->getFilters() as $filter => $value) {
            $this->resolveFilter($filter)->filter($builder,$value);
        }
        return $builder;
    }

    /**
     * @return array
     */
    protected function getFilters()
    {
        return empty($this->inspectFilter($this->filters))?$this->defaultFilter:$this->inspectFilter($this->filters);
    }

    protected function inspectFilter(array $filter)
    {
        return array_filter($this->request->only(array_keys($filter)));
    }

    protected function resolveFilter($filter)
    {
        return new $this->filters[$filter];
    }

    public function add(array $otherFilter)
    {
        $this->filters = array_merge($this->filters, $otherFilter);
         return $this;
    }
}
