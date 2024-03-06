<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;


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
    /**
     * Render the exception into an HTTP response.
     */

    function getStatusCode(Throwable $exception): int
    {
        if ($exception instanceof HttpExceptionInterface) {
            return $exception->getStatusCode();
        }

        // Default status code for non-HTTP exceptions
        return 500;
    }


    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception)) {
            $statusCode = $this->getStatusCode($exception);

            if ($statusCode == 403) {
                return response()->view('errors.403', [], $statusCode);
            } elseif ($statusCode == 404) {
                return response()->view('errors.404', [], $statusCode);
            } else {
                return response()->view('errors.500', [], $statusCode);
            }
        }

        return parent::render($request, $exception);
    }
}
