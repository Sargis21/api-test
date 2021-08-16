<?php


namespace App\Helpers;


use Illuminate\Support\Str;

class ResponseJson
{
    public static function response($status = 200, $message = 'success')
    {
        return response()->json( [
            'error' => [
                'message' => Str::limit($message, 100),
                'status' => $status,
            ]
        ], $status);
    }
}
