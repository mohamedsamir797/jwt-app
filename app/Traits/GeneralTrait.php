<?php


namespace App\Traits;


trait GeneralTrait
{
    public function returnError($errNum , $msg){
        return response()->json([
            'status' => false ,
            'errNum' => $errNum ,
            'msg' => $msg
        ]);
    }
    public function returnSuccess($msg = "",$errNum = "" ){
        return response()->json([
            'status' => true ,
            'errNum' => $errNum ,
            'msg' => $msg
        ]);
    }

    public function returnData($key , $value, $msg=""){
        return response()->json([
            'status' => true ,
            'errNum' => 'success' ,
            'msg' => $msg ,
            $key => $value
        ]);
    }
}