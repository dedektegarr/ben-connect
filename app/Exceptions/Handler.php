<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
   
    public function render($request, Throwable $e){
        //Error permission
        if($e instanceof UnauthorizedException){
            return response()->json([
                'status_code' => 403,
                'message' => 'Akses tidak diizinkan'
            ], 403);
        }
        //Error otentikasi, belum login, token invalid
        if($e instanceof AuthenticationException){
            return response()->json([
                'status_code' => 401,
                'message' => 'Anda belum login atau token tidak valid'
            ], 401);
        }
        //Error validasi
        if($e instanceof ValidationException){
            return response()->json([
                'status_code' => 400,
                'message' => 'Input tidak valid',
                'errors' => $e->errors()
            ], 400);
        }
        //Endpoint ridak ditemukan (404)
        // if($e instanceof NotFoundHttpException){
        //     return response()->json([
        //         'status_code' => 404,
        //         'message' => 'Route tidak ditemukan'
        //     ], 404);
        // }
        return parent::render($request, $e);
    }
}
