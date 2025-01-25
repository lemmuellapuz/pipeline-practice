<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ByName
{

    public function __construct(protected ?string $name)
    {
        
    }

    public function __invoke(Builder $builder, \Closure $next)
    {
        return $next($builder)
        ->when($this->name, function($query){
            $query->where('name', 'LIKE', '%' . $this->name . '%');
        });
    }

}