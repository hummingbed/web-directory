<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HttpResponses
{
    protected function successHttpMessage($data, $message, $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorHttpMessage($data, $code = 400, $message = null): JsonResponse
    {
        return response()->json([
            'status' => 'failed',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function paginateSuccessHttpMessage($data, $message, $paginate = null, $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data->items(),
            'links' => [
                'first' => $paginate->url(1),
                'last' => $paginate->url($paginate->lastPage()),
                'prev' => $paginate->previousPageUrl(),
                'next' => $paginate->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $paginate->currentPage(),
                'from' => $paginate->firstItem(),
                'last_page' => $paginate->lastPage(),
                'path' => $paginate->path(),
                'per_page' => $paginate->perPage(),
                'to' => $paginate->lastItem(),
                'total' => $paginate->total(),
            ],
        ], $code);
    }
}
