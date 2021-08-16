<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Str;
use Throwable;

class ErrorException extends Exception
{
    public $error;
    public function __construct($error, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->error = $error;
    }
    public function render($request)
    {
        return response()->json( [
            'error' => [
                'message' => Str::limit($this->error, 100),
                'status' => 400,
            ]
        ], 400);
    }
}
