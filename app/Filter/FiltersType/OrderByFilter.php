<?php


namespace App\Filter\FiltersType;


use App\Filter\Contract\IFilter;
use App\Filter\FilterTrait;
use Illuminate\Database\Eloquent\Builder;

class OrderByFilter implements IFilter
{
    use FilterTrait;
    const COLUMN_NAME ='created_at';
    const DEFAULT_VALUE ='desc';

    public function filter(Builder $builder, $value)
    {
          return is_null($this->resolveValue($value)) ? $builder->orderBy(self::COLUMN_NAME,self::DEFAULT_VALUE) : $builder->orderBy(self::COLUMN_NAME, $this->resolveValue($value));
    }

    public function mappings()
    {
        return [
            'newest' => 'desc',
            'older' => 'asc',
        ];
    }
}
