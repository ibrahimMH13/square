<?php


namespace App\Filter;


use Illuminate\Support\Arr;

trait FilterTrait
{

    public function mappings(){
        return [];
    }

    public function resolveValue($value){
        return Arr::get($this->mappings(),$value);
    }

}
