<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Exception $exception, $request) {
            if($exception instanceof TokenBlacklistedException) {
                return response(['error' => 'Token cannot be used, get new one'], Response::HTTP_BAD_REQUEST);
            }
            elseif($exception instanceof TokenInvalidException) {
                return response(['error' => 'Token is invalid'], Response::HTTP_BAD_REQUEST);
            }
            elseif($exception instanceof TokenExpiredException) {
                return response(['error' => 'Token is expired'], Response::HTTP_BAD_REQUEST);
            }
            elseif($exception instanceof JWTException) {
                return response(['error' => 'Token is not Provided'], Response::HTTP_BAD_REQUEST);
            }
        });
    }
}
