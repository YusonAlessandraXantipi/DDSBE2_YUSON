<?php

namespace App\Traits;

<<<<<<< HEAD
use Illuminate\Http\Response;

trait ApiResponser
{
    /**
     * Build success response
     * @param string|array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data], $code);
    }

    /**
     * Build error responses
     * @param string|array $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code)
    {
        return response()->json([
            'error' => $message,
            'code' => $code
        ], $code);
=======
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
>>>>>>> 7a08be47408650d080d9694e0db59fc0ecb4f55c
    }
}
