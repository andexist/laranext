<?php

namespace App\Exceptions;

use App\Exceptions\Elasticsearch\ElasticsearchRepositoryNotFoundException;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Symfony\Component\HttpFoundation\Response;

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

        $this->renderable(function(NotFoundHttpException $e, $request) {
            if ($request->is('api/*') && !str_contains($request->getRequestUri(), 'export')) {
                return response()->json(
                    [
                        'status' => Response::HTTP_NOT_FOUND,
                        'error'  => [
                            'message' => 'Resource Not Found',
                            'type' => 'NotFoundHttpException',
                            'status' => (string)$e->getStatusCode(), 
                    ],
                ], Response::HTTP_NOT_FOUND);
            }
        });

        $this->renderable(function(NotFoundHttpException $e, $request) {
            return response()->json(
                [
                    'status' => Response::HTTP_NOT_FOUND,
                    'error'  => [
                        'message' => 'Resource Not Found',
                        'type' => 'NotFoundHttpException',
                        'status' => (string)$e->getStatusCode(), 
                ],
            ], Response::HTTP_NOT_FOUND);
        });
        
        $this->renderable(function(InvalidArgumentException $e, $request) {
            return response()->json(
                    [
                        'status' => Response::HTTP_BAD_REQUEST,
                        'error'  => [
                            'code'    => $e->getCode(),
                            'type'    => $e->getType(),
                            'message' => $e->getMessage()
                        ]
                    ]
                )->setStatusCode(Response::HTTP_BAD_REQUEST);
            }
        );

        $this->renderable(function(InvalidFormatException $e, $request) {
            return response()->json(
                    [
                        'status' => Response::HTTP_BAD_REQUEST,
                        'error'  => [
                            'code'    => Response::HTTP_BAD_REQUEST,
                            'type'    => 'InvalidFormatException',
                            'message' => $e->getMessage()
                        ]
                    ]
                )->setStatusCode(Response::HTTP_BAD_REQUEST);
            }
        );

        $this->renderable(function(AccessDeniedHttpException $e, $request) {
            return response()->json(
                    [
                        'status' => Response::HTTP_FORBIDDEN,
                        'error'  => [
                            'code'    => Response::HTTP_BAD_REQUEST,
                            'type'    => 'AccessDeniedHttpException',
                            'message' => $e->getMessage()
                        ]
                    ]
                )->setStatusCode(Response::HTTP_FORBIDDEN);
            }
        );

        $this->renderable(function(ElasticsearchRepositoryNotFoundException $e, $request) {
            return response()->json(
                    [
                        'status' => Response::HTTP_NOT_FOUND,
                        'error'  => [
                            'code'    => Response::HTTP_NOT_FOUND,
                            'type'    => $e->getType(),
                            'message' => $e->getMessage()
                        ]
                    ]
                )->setStatusCode(Response::HTTP_NOT_FOUND);
            }
        );
    }
}
