<?php

namespace App\Http\Controllers\ApiResponse;

use App\Http\Controllers\Controller;

class ApiController extends Controller {

    public function successResponse ($message , $data , $statusCode , $authorisation = null) {
        if ($authorisation != null) {
            return response()->json([
                'Status'  => 'Success',
                'Message' => $message,
                'Data'    => $data,
                'Authorisation' => ['token' => $authorisation , 'type' => 'bearer']
            ],$statusCode);
        }else {
            return response()->json([
                'Status'  => 'Success',
                'Message' => $message,
                'Data'    => $data,
            ],$statusCode);
        }
    }

    public function failedResponse ($message , $statusCode) {
            return response()->json([
                'Status'  => 'Failed',
                'Message' => $message,
                'Data'    => Null,
            ],$statusCode);
    }
}
