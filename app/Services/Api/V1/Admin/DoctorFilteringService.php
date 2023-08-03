<?php

namespace App\Services\Api\V1\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class DoctorFilteringService
{
    public static function byDoctorName($request, Builder $builder): Builder
    {
        if (isset($request['name'])) {
            $name = $request['name'];
            $names = explode(' ', $name);
            if (count($names) === 1) {
                $builder = $builder->where(fn (Builder $query) => $query
                    ->where('first_name', 'like', '%'.$name.'%')
                    ->orWhere('last_name', 'like', '%'.$name.'%')
                );
            }
            if (count($names) === 2) {
                $builder = $builder->where(fn (Builder $query) => $query
                    ->where('first_name', 'like', '%'.$names[0].'%')
                    ->orWhere('last_name', 'like', '%'.$names[1].'%')
                    ->orWhere('first_name', 'like', '%'.$names[1].'%')
                    ->orWhere('last_name', 'like', '%'.$names[0].'%')
                );
            }
           
        }        

        return $builder;
    }
}