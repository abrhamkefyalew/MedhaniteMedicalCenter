<?php

namespace App\Services\Api\V1\Customer;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class HospitalFilteringService
{
    public static function byHospitalNameAndDescription($request, Builder $builder): Builder
    {
        if (isset($request['hospital_name_search'])) {
            $hospitalName = $request['hospital_name_search'];
            $builder = $builder->where(fn (Builder $query) => $query
                    ->where('hospital_name', 'like', '%'.$hospitalName.'%')
                );
        }
        // if (isset($request['hospital_description'])) {
        //     $hospitalDescription = $request['hospital_description'];
        //     $builder = $builder->where(fn (Builder $query) => $query
        //             ->where('hospital_description', 'like', '%'.$hospitalDescription.'%')
        //         );
        // }

        return $builder;
    }
}