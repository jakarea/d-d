<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


use Throwable;

class Handler extends ExceptionHandler {
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register() {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // public function render($request, Throwable $exception) {
    //     if ($exception instanceof ModelNotFoundException) {
    //         return response([
    //             'error' => 1,
    //             'message' => $exception->getMessage(),
    //         ], 404);
    //     }

    //     if ($exception instanceof MissingAbilityException) {
    //         return response([
    //             'error' => 1,
    //             'message' => 'Not authorized',
    //         ], 409);
    //     }

    //     return parent::render($request, $exception);
    // }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException && $this->isApiRequest($request)) {
            return $this->renderApiNotFound();
        }

        if ($exception instanceof AuthenticationException && $this->isApiRequest($request)) {
            return $this->renderApiAuthenticationError();
        }

        if ($exception instanceof MethodNotAllowedHttpException && $this->isApiRequest($request)) {
            return $this->renderApiMethodNotAllowed();
        }

        return parent::render($request, $exception);
    }

    protected function renderApiNotFound(): JsonResponse
    {
        return response()->json([
            'error' => 'Resource not found',
            'message' => '404 | Not Found',
            'data' => [],
            'errors' => [],
        ], 404);
    }

    protected function renderApiAuthenticationError(): JsonResponse
    {
        return response()->json([
            'error' => 'Unauthenticated',
            'message' => '401 | Unauthenticated',
            'data' => [],
            'errors' => [],
        ], 401);
    }

    protected function renderApiMethodNotAllowed(): JsonResponse
    {
        return response()->json([
            'error' => 'Method Not Allowed',
            'message' => '405 | Method Not Allowed',
            'data' => [],
            'errors' => [],
        ], 405);
    }

    protected function isApiRequest(Request $request): bool
    {
        return $request->wantsJson() || $request->is('api/*');
    }
}
