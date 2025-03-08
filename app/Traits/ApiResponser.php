<?php

namespace App\Traits;

trait ApiResponser
{
    protected function successResponse($data, $message = "", $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], (int) $status); // Ensure status is an integer
    }

    protected function errorResponse($message, $status = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], (int) $status); // Ensure status is an integer
    }
}
