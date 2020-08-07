<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler {

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
    public function report(Throwable $exception) {
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
    public function render($request, Throwable $exception) {
        $code_str = 'INTERNAL_SERVER_ERROR';

        if ($exception instanceof HttpResponseException) {
            return $exception->getResponse();
        } elseif ($exception instanceof ModelNotFoundException) {
            $code_str = 'RECORD_NOT_FOUND';
            $exception = new NotFoundHttpException($exception->getMessage(), $exception);
        } elseif ($exception instanceof AuthorizationException) {
            $code_str = 'UNAUTHORIZE_ACCESS';
            $exception = new HttpException(403, $exception->getMessage());
        } elseif ($exception instanceof ValidationException && $exception->getResponse()) {
            $code_str = 'VALIDATION_ERROR';
            return $exception->getResponse();
        } elseif ($exception instanceof NotFoundHttpException) {
            $code_str = 'PAGE_NOT_FOUND';
            $exception = new NotFoundHttpException($exception->getMessage(), $exception);
        }

        $fe = FlattenException::createFromThrowable($exception);

        //$handler = new SymfonyExceptionHandler(env('APP_DEBUG', config('app.debug', false)));
        //$decorated = $this->decorate($handler->getContent($fe), $handler->getStylesheet($fe));
        //$response = new Response($decorated, $fe->getStatusCode(), $fe->getHeaders());
        //$response->exception = $exception;

        $code = $fe->getStatusCode();
        $resp = array(
            'status' => false,
            'request_status' => true,
            'message' => $fe->getMessage(),
            'code' => $code,
            'error' => array(
                'code' => $code_str,
                'detail' => $fe->toArray(),
                'html' => $fe->getMessage(),
            )
        );
        return response()->json($resp, $code);
    }

}
