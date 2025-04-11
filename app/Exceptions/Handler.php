<?php

namespace App\Exceptions;
<<<<<<< HEAD
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use App\Traits\ApiResponser;
=======

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
>>>>>>> 7a08be47408650d080d9694e0db59fc0ecb4f55c

class Handler extends ExceptionHandler
{
    use ApiResponser;
<<<<<<< HEAD
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }
=======
>>>>>>> 7a08be47408650d080d9694e0db59fc0ecb4f55c

    /**
     * Render an exception into an HTTP response.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
=======
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
>>>>>>> 7a08be47408650d080d9694e0db59fc0ecb4f55c
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
<<<<<<< HEAD

        // Handle HTTP exceptions (404, 500, etc.)
        if ($exception instanceof HttpException) {
            $code = $exception->getStatusCode();
            $message = Response::$statusTexts[$code] ?? 'Http Error';
            return $this->errorResponse($message, $code);
        }

        // Handle model not found
        if ($exception instanceof ModelNotFoundException) {
            $model = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("Does not exist any instance of {$model} with the given id", Response::HTTP_NOT_FOUND);
        }

        // Handle validation exceptions
        if ($exception instanceof ValidationException) {
            $errors = $exception->validator->errors()->getMessages();
            return $this->errorResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Handle forbidden access
        if ($exception instanceof AuthorizationException) {
            return $this->errorResponse($exception->getMessage(), Response::HTTP_FORBIDDEN);
        }

        // Handle unauthenticated access
=======
        // HTTP exceptions (404, 403, etc.)
        if ($exception instanceof HttpException) {
            $code = $exception->getStatusCode();
            $message = Response::$statusTexts[$code] ?? "HTTP Error";

            return $this->errorResponse($message, $code);
        }

        // Model not found
        if ($exception instanceof ModelNotFoundException) {
            $model = strtolower(class_basename($exception->getModel()));

            return $this->errorResponse("No instance of {$model} found", Response::HTTP_NOT_FOUND);
        }

        // Validation errors
        if ($exception instanceof ValidationException) {
            $errors = $exception->validator->errors()->getMessages();

            return $this->errorResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Authorization errors
        if ($exception instanceof AuthorizationException) { 
            return $this->errorResponse($exception->getMessage(), Response::HTTP_FORBIDDEN);
        }

        // Authentication errors
>>>>>>> 7a08be47408650d080d9694e0db59fc0ecb4f55c
        if ($exception instanceof AuthenticationException) {
            return $this->errorResponse($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
        }

<<<<<<< HEAD
        // Development environment shows full error
=======
        // If in debug mode, show full exception
>>>>>>> 7a08be47408650d080d9694e0db59fc0ecb4f55c
        if (env('APP_DEBUG', false)) {
            return parent::render($request, $exception);
        }

<<<<<<< HEAD
        // Fallback for other errors
        return $this->errorResponse('Unexpected error. Try later', Response::HTTP_INTERNAL_SERVER_ERROR);
=======
        // General error response
        return $this->errorResponse('Unexpected error. Try again later', Response::HTTP_INTERNAL_SERVER_ERROR);
>>>>>>> 7a08be47408650d080d9694e0db59fc0ecb4f55c
    }
}
