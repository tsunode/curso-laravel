<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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

    public function render($request, Throwable $exception) {
      if ($exception instanceof ValidationException) {
        return response()->json([
          'errors' => $exception->validator->errors(),
        ], 422);
      }

      if ($exception instanceof NotFoundHttpException) {
        return response()->json([
          'errors' => 'Rota não encotrada',
        ], 404);
      }

      if ($exception instanceof AuthorizationException) {
        return response()->json([
          'errors' => 'Rota não autorizada',
        ], 403);
      }

      if ($exception instanceof AppError) {
        return response()->json([
          'errors' => $exception->getMessage(),
        ], $exception->getCode());
      }

      Log::error('Internal Server Error', [$exception]);

      return response()->json([
        'message' => 'Ocorreu um erro interno no servidor.',
      ], 500);
    }
}
