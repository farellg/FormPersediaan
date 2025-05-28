<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->renderable(function (Throwable $e, $request) {
            if ($e instanceof TokenMismatchException) {
                return redirect()->route('login')->withErrors([
                    'expired' => 'Sesi anda telah habis, silakan login kembali.',
                ]);
            }
        });
    }
    
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof TokenMismatchException) {
            return redirect()->route('login')->with('error', 'Session anda telah habis, silakan login kembali.');
        }

        return parent::render($request, $exception);
    }
}
