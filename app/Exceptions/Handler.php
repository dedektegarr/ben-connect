<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Spatie\Permission\Exceptions\UnauthorizedException;

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
        if($e instanceof UnauthorizedException){
            return response()->json([
                'status_code' => 403,
                'message' => 'Akses tidak diizinkan'
            ], 403);
        }

        if($e instanceof AuthenticationException){
            return response()->json([
                'status_code' => 401,
                'message' => 'Anda belum login atau token tidak valid'
            ], 401);
        }
        return parent::render($request, $e);
    }
}
