<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

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
        $this->renderable(function (HttpException $e) {
            if ($e->getStatusCode() == 500) {
                return response()->json([
                    'message' => 'Server Error'
                ], 404);
            }
            if ($e->getStatusCode() == 404) {
                $message = 'Row not found';
                if(str_contains($e->getMessage(), 'The route')) $message = 'Route not found';
                return response()->json([
                    'message' => $message
                ], 404);
            }
        });

        $this->renderable(function (RouteNotFoundException $e, $request) {
            $message = 'Route Not Found';
            if(str_contains($e->getMessage(), 'Route [login] not defined')) $message = 'Token not found';
            return response()->json([
                'message' => $message
            ], 404);
        });
    }
}
