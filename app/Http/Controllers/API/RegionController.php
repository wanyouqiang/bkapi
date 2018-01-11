<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Region;


class RegionController extends ApiController
{
    //
    public function index(Request $request)
    {
        $data = [
            'list'=>Region::all()
        ];
        return $this->apiResponse('ok', R_OK, $data);
    }

    public function getDist(Request $request)
    {
        if(empty($request->id)){
            $dist = Region::where('level',3)->get();
        }else{
            $dist = Region::where('level',3)->where('parent_id',$request->id)->get();
        }
        return $this->apiResponse('ok', R_OK,['result' => $dist]);
    }

    public function getCity(Request $request)
    {
        if(empty($request->id)){
            $city = Region::where('level',2)->get();
        }else{
            $city = Region::where('level',2)->where('parent_id',$request->id)->get();
        }
        return $this->apiResponse('ok', R_OK, ['result' => $city]);
    }

    public function getProvince(Request $request)
    {
        $province = Region::where('level',1)->get();
        return $this->apiResponse('ok', R_OK, ['result' => $province]);
    }
}
