<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ByEmail
{

    public function __construct(protected ?string $email)
    {
        
    }

    public function __invoke(Builder $builder, \Closure $next)
    {
        return $next($builder)
        ->when($this->email, function($query){
            $query->where('email', 'LIKE', '%' . $this->email . '%');
        });
    }

}
