<?php
namespace App\Http\Controllers\api\custom1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class ExampleController extends Controller
{
    public function exampleMethod(Request $request){
        // $query = ExampleTable::query();
        // Helper::doPaginate($request, $query);
        // Helper::doFilter($request, $query);
        // // Helper::doSearch($request, $query, "keu_spp.spp_name");
        // Helper::doGetTrash($request, $query);
        // $data = $query->get();
        // return responseSuccess($data); //* create utility for create response
    }
}