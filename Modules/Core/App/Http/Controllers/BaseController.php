<?php

namespace Modules\Core\App\Http\Controllers;
use App\Http\Controllers\Controller;

abstract class BaseController extends Controller{
    public function successResponse($data, $message = 'Success'){
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public function errorResponse($message = 'Error', $code = 400){
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }
}