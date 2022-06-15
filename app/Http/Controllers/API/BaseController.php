<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class BaseController extends Controller
{
    public static function sendResponse($result,$message)
    {
        $response=[
            'success'=>true,
            'message'=>$message,
            'data'=>$result
        ];
        return response()->json($response,200);
    }



    public  static function sendError($error,$errorMessage=[],$code=500)

    {
        $response=[
            'success'=>false,
            'message'=>$error,
         ];
         if(!empty($errorMessage)){
             $response['data']=$errorMessage;
}
        return response()->json($response,$code);
    }
}
