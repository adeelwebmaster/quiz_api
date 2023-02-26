<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
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

    public function render($request, Throwable $e)
    {
        $response = array('success' => false, "errors" => null, "data" => null);
        $httpCode = 500;
        if($e instanceof HttpExceptionInterface)
        {
            $httpCode = $e->getStatusCode() == 0 ? 500 : $e->getStatusCode();
        }
        elseif($e instanceof ModelNotFoundException)
        {
            $httpCode = 404;
        }

        if($httpCode == 404)
        {
            $response['errors'] = array(1);
        }
        elseif($httpCode == 500)
        {
            $response['errors'] = array(2);
        }

        return response()->json($response, $httpCode, ["Content-Type"=> "application/json"]);
    }
}
