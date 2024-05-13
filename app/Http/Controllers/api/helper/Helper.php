<?php

namespace App\Http\Controllers\api\helper;

use App\Constant\CommonConstant;
use App\Constant\ParamKeyValueConstant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Helper{
    public static function doSelectMode(Request $request, $default = null){
        if(is_null($default)){
            return ['*'];
        }else{
            // select mode
            if ($request->query(ParamKeyValueConstant::MODE) == ParamKeyValueConstant::VALUE_ALL) {
                return ["*"];
            }else if($request->query(ParamKeyValueConstant::MODE) == ParamKeyValueConstant::VALUE_MANUAL){
                //todo implement this
                return ["*"];
            }
            return $default;
        }   
        
    }


    public static function doSearch($request, $query, $column){
        // Pencarian
        if ($request->has(ParamKeyValueConstant::SEARCH)) {
            $query->where(
                $column, 
                'like', 
                '%' . $request->input(ParamKeyValueConstant::SEARCH) . '%'
            );
        }
    }


    public static function doSearchMultipleColumn($request, $query, $columns){
        if ($request->has(ParamKeyValueConstant::SEARCH)) {
            $searchTerm = '%' . $request->input(ParamKeyValueConstant::SEARCH) . '%';

        $query->where(function($query) use ($columns, $searchTerm) {
            foreach($columns as $column) {
                $query->orWhere($column, 'LIKE', $searchTerm);
            }
        });
    }
    }


    public static function doFilter($request, $query){
        // Filter
        if ($request->has(ParamKeyValueConstant::FILTER_KEY) && $request->has(ParamKeyValueConstant::FILTER_VALUE) ) {
            $query->where($request->input(ParamKeyValueConstant::FILTER_KEY), $request->input(ParamKeyValueConstant::FILTER_VALUE));
        }
    }

    public static function doGetTrash($request, $query){
        // Filter
        if ($request->has(ParamKeyValueConstant::ONLY_TRASHED) && $request->input(ParamKeyValueConstant::ONLY_TRASHED) == ParamKeyValueConstant::ONLY_TRASHED_VALUE) {
            $query->onlyTrashed();
        }
    }


    public static function doPaginate($request, $query){
        if ($request->has(ParamKeyValueConstant::PAGE) && $request->has(ParamKeyValueConstant::PER_PAGE)) {
            $currentPage = $request->input(ParamKeyValueConstant::PAGE, 1);
            $perPage = $request->input(ParamKeyValueConstant::PER_PAGE, 1);
            $query->skip(($currentPage-1) * $perPage)
                ->take($perPage);
        }
    }


    public static function doPaginateByFirstAndRow($request, $query){
        if ($request->has(ParamKeyValueConstant::FIRST) && $request->has(ParamKeyValueConstant::PER_PAGE)) {
            $first = $request->input(ParamKeyValueConstant::FIRST, 0);
            $rowsPerPage = $request->input(ParamKeyValueConstant::PER_PAGE, 10);
            
            $query->skip($first)->take($rowsPerPage);
        }
    }
    
    
    //* if each table has education_level_id column and you want to filter data based on education_level_id

    public static function addEducationLevelCondition($query, $key = "education_level_id"){
        if(Auth::check()){
            $auth = Auth::user();
            // Jika peran user adalah SUPER_ADMIN, tidak perlu menambahkan kondisi WHERE
            // if ($auth->role === CommonConstant::SUPER_ADMIN) {
            //     return $query;
            // }
            return $query->where($key, $auth->education_level_id);
        }
    }

    public static function addEducationLevelConditionORM($query, $orm, $key = "education_level_id"){
        if(Auth::check()){
            $auth = Auth::user();
            // Jika peran user adalah SUPER_ADMIN, tidak perlu menambahkan kondisi WHERE
            // if ($auth->role === CommonConstant::SUPER_ADMIN) {
            //     return $query;
            // }
            return $query->whereHas($orm, function($query) use ($auth, $key) {
                $query->where($key, $auth->education_level_id);
            });
        }
    }
    

    public static function doFilterMultipleOnRequestParams($request, $query){
        // Filter
        if ($request->has(ParamKeyValueConstant::FILTER_KEY) && $request->has(ParamKeyValueConstant::FILTER_VALUE)) {
            // Mengambil array dari kunci dan nilai dari request parameters
            $filterKeys = $request->input(ParamKeyValueConstant::FILTER_KEY);
            $filterValues = $request->input(ParamKeyValueConstant::FILTER_VALUE);
            
            // Memastikan panjang kedua array sama
            if(count($filterKeys) === count($filterValues)) {
                // Iterasi melalui setiap pasangan kunci-nilai
                foreach($filterKeys as $index => $key) {
                    $value = $filterValues[$index];
                    // Tambahkan klausa where untuk setiap pasangan kunci-nilai
                    $query->where(function ($query) use ($key, $value) {
                        $query->where($key, $value);
                    });
                }
            }
        }
    }

    public static function generateUUID(){
        return (string) Str::uuid();
    }
}
