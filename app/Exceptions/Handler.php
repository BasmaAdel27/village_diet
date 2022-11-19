<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use MattDaneshvar\Survey\Exceptions\MaxEntriesPerUserLimitExceeded;
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
                return failedResponse(__('page_not_found'));
            }

            if ($throwable instanceof \Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException) {
                return failedResponse(trans('number_is_not_correct_please_connect_with_support'), 429);
            }
        }

        if ($throwable instanceof MaxEntriesPerUserLimitExceeded) {
            return throw  \Illuminate\Validation\ValidationException::withMessages(['message' => trans('maximum_entries_per_user_exceeded')]);
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
