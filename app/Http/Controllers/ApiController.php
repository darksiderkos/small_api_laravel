<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;


class ApiController extends Controller
{
    protected $statusCode = 200;

    protected $fractal;


    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
        if (\Request::get('include')) {
            $this->fractal->parseIncludes(\Request::get('include'));
        }

    }


    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }


    public function respondWithItem($item, $callback)
    {
        $resource = new Item($item, $callback);
        $rootScope = $this->fractal->createData($resource);
        return $this->respondWithArray($rootScope->toArray());
    }

    public function respondWithCollection($collection, $callback)
    {
        $resource = new Collection($collection, $callback);
        $rootScope = $this->fractal->createData($resource);
        return $this->respondWithArray($rootScope->toArray());
    }

    public function respondWithArray(array $array, array $headers = [])
    {
        return Response::json($array, $this->statusCode, $headers);
    }

    public function respondWithPagination($paginator, $callback)
    {
        $queryParams = array_diff_key($_GET, array_flip(['page']));
        $paginator->appends($queryParams);
        $resource = $paginator->getCollection();
        $resource = new Collection($resource, $callback);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        $rootScope = $this->fractal->createData($resource);
        return $this->respondWithArray($rootScope->toArray());
    }

    public function respondWithError($message)
    {

        return $this->respondWithArray([
            'error' => [
                'http_code' => $this->statusCode,
                'message' => $message,
            ]
        ]);
    }

    public function errorNotFound($message = 'Resource not found')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    public function errorWrongArgs($message = 'Wrong args used')
    {
        return $this->setStatusCode(400)->respondWithError($message);
    }

    public function errorNotAuthorized($message = 'You are not authorized')
    {
        return $this->setStatusCode(401)->respondWithError($message);
    }

    public function errorForbidden($message = 'Request forbidden')
    {
        return $this->setStatusCode(403)->respondWithError($message);
    }

    public function errorNotAcceptable($message = 'Input is not acceptable')
    {
        return $this->setStatusCode(406)->respondWithError($message);

    }


}
