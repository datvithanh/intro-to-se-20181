<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function __construct()
    {
    }
    public function success($data = null)
    {
        return $this->respond($data, 200);
    }

    public function resourceCreated($data = null)
    {
        return $this->respond($data, 201);
    }
    public function badRequest($data = null)
    {
        return $this->respond($data, 400);
    }

    public function notFound($data = null)
    {
        return $this->respond($data, 404);
    }

    public function notModified($data = null)
    {
        return $this->respond($data, 304);
    }

    public function unauthorized($data = null)
    {
        return $this->respond($data, 401);
    }

    public function respond($data = [], $httpCode)
    {
        return response()->json($data, $httpCode);
    }
}
