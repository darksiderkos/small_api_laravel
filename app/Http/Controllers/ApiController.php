<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Manager;


class ApiController extends Controller
{
    protected $statusCode = 200;
    protected $fractal;



    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
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

    public function respondWithError($message)
    {

        return $this->respondWithArray([
            'error'=>[
                'http_code' => $this->statusCode,
                'message' => $message,
            ]
        ]);
    }

    public function errorNotFound($message = 'Resource not found')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }





}
