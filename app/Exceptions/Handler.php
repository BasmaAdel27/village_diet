<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $throwable)
    {
        if ($request->wantsJson()) {
            if ($throwable instanceof ModelNotFoundException || $throwable instanceof NotFoundHttpException) {
                return response()->json([
                    'status' => false,
                    'message' => __('page_not_found'),
                    'data' => null
                ], 404);
            }
        }
        return parent::render($request, $throwable);
    }


    protected function invalidJson($request, ValidationException $exception)
    {
        $errors = Arr::flatten($exception->errors(), 1);

        return response()->json(
            [
                'status' => false,
                'message' => Arr::first($errors, null, $exception->getMessage()),
                'errors'  => $errors,
            ],
            $exception->status
        );
    }
}
