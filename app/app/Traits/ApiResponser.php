<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Yajra\DataTables\Facades\DataTables;

trait ApiResponser
{
    public function successResponse($data, $message = '', $code = 200)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'code' => $code
        ];
        if (isset($data) && !empty($data) && is_array($data) && isset($data['data'])) {
            $response = array_merge($response, $data);
        } else {
            $response['data'] = $data;
        }
        return response()->json($response, $code);
    }


    public function errorResponse($message = '', $code = 200)
    {
        $response = [
            'success' => false,
            'data' => '',
            'error' => true,
            'message' => $message,
            'code' => $code
        ];
        return response()->json($response, $code);
    }

    protected function cacheResponse($data)
    {
        $url = request()->url();
        $queryParams = request()->query();

        ksort($queryParams);

        $queryString = http_build_query($queryParams);

        $fullUrl = "{$url}?{$queryString}";

        return Cache::remember($fullUrl, 30 / 60, function () use ($data) {
            return $data;
        });
    }
}
