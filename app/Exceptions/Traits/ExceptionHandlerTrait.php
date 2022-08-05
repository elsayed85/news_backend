<?php

namespace App\Exceptions\Traits;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

trait ExceptionHandlerTrait
{
    public Throwable $e;

    public function handelException(Throwable $e)
    {
        $this->e = $e;
        dd('hey');
        switch (true) {
            case $e instanceof AuthorizationException:
                return $this->AuthorizationExceptionHandler();
                break;
            case $e instanceof AuthenticationException:
                return $this->AuthenticationException();
                break;
            case $e instanceof PostTooLargeException:
                return $this->PostTooLargeException();
                break;
            case $e instanceof ThrottleRequestsException:
                return $this->ThrottleRequestsException();
                break;
            case $e instanceof ModelNotFoundException:
                return $this->ModelNotFoundException();
                break;
            case $e instanceof ValidationException:
                return $this->ValidationException();
                break;
            case $e instanceof QueryException:
                return $this->QueryException();
                break;
            case $e instanceof MethodNotAllowedHttpException:
                return $this->MethodNotAllowedHttpExceptionHandler();
                break;
        }
    }

    public function AuthorizationExceptionHandler()
    {
        return response()->json([
            'message' =>  $this->e->getMessage(),
            'success' => false,
            'code' => 401
        ],  401);
    }

    public function MethodNotAllowedHttpExceptionHandler()
    {
        return response()->json([
            'message' => $this->e->getMessage(),
            'success' => false,
            'code' => 401
        ],  405);
    }

    public function PostTooLargeException()
    {
        return response()->json(
            [
                'success' => false,
                'message' => "Size of attached file should be less " . ini_get("upload_max_filesize") . "B"
            ],
            400
        );
    }
    public function AuthenticationException()
    {
        return response()->json(
            [
                'success' => false,
                'message' => 'Unauthenticated or Token Expired, Please Login'
            ],
            401
        );
    }
    public function ThrottleRequestsException()
    {
        return response()->json(
            [
                'success' => false,
                'message' => 'Too Many Requests,Please Slow Down'
            ],
            429
        );
    }
    public function ValidationException()
    {
        return response()->json(
            [
                'success' => false,
                'message' => $this->e->getMessage(),
                'errors' => $this->e->errors()
            ],
            422
        );
    }
    public function QueryException()
    {
        return response()->json(
            [
                'success' => false,
                'message' => 'There was Issue with the Query',
                'exception' => $this->e

            ],
            500
        );
    }
}
