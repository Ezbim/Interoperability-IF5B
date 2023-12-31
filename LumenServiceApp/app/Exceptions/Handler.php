<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
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

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
{
    if (env('APP_DEBUG')) {
        return parent::render($request, $exception);
    }

    $status = Response::HTTP_INTERNAL_SERVER_ERROR;
    $message = 'HTTP_INTERNAL_SERVER_ERROR';

    if ($exception instanceof HttpResponseException) {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'HTTP_INTERNAL_SERVER_ERROR';
    } elseif ($exception instanceof MethodNotAllowedHttpException) {
        $status = Response::HTTP_METHOD_NOT_ALLOWED;
        $message = 'HTTP_METHOD_NOT_ALLOWED';
    } elseif ($exception instanceof NotFoundHttpException) {
        $status = Response::HTTP_NOT_FOUND;
        $message = 'HTTP_NOT_FOUND';
    } elseif ($exception instanceof AuthorizationException) {
        $status = Response::HTTP_FORBIDDEN;
        $message = 'HTTP_FORBIDDEN';
    } elseif ($exception instanceof \Illuminate\Validation\ValidationException && $exception->getResponse()) {
        $status = Response::HTTP_BAD_REQUEST;
        $message = 'HTTP_BAD_REQUEST';
    } elseif ($exception) {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'HTTP_INTERNAL_SERVER_ERROR';
    } elseif ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
        $status = Response::HTTP_NOT_FOUND;
        $message = 'HTTP_NOT_FOUND';
    } elseif ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
        $status = Response::HTTP_NOT_FOUND;
        $message = 'HTTP_NOT_FOUND';
    } elseif ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
        $status = Response::HTTP_METHOD_NOT_ALLOWED;
        $message = 'HTTP_METHOD_NOT_ALLOWED';
    } elseif ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
        $status = $exception->getStatusCode();
        $message = $exception->getMessage();
    } elseif ($exception instanceof \Illuminate\Auth\AuthenticationException) {
        $status = Response::HTTP_UNAUTHORIZED;
        $message = 'HTTP_UNAUTHORIZED';
    } elseif ($exception instanceof \Illuminate\Database\QueryException) {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'HTTP_INTERNAL_SERVER_ERROR';
    } 

    return response()->json([
        'success' => false,
        'status' => $status,
        'message' => $message,
    ], $status);
    }
}