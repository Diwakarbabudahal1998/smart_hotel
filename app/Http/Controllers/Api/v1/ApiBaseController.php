<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pusher\Pusher;

class ApiBaseController extends Controller
{
    public function successResponse($message, int $statusCode = 200)
    {
        return response()->json(['code' => $statusCode, 'message' => $message, 'status' => true]);
    }

    public function successData($message, $data = [], $statusCode = 200)
    {
        return response()->json(['code' => $statusCode,'message' => $message, 'data' => $data]);
    }

    public function errorResponse($message, int $statusCode = 204)
    {
        return response()->json(['code' => $statusCode, 'message' => $message]);
    }

    public function errorData($message, $data=[], $statusCode = 500)
    {
        return response()->json(['code' => $statusCode,'message' => $message,'data' => $data]);
    }

}
