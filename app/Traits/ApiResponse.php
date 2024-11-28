<?php

namespace App\Traits;

trait ApiResponse
{
    public function response(
        $code = 200,
        $message = 'Petición exitosa',
        $errors = [],
        $data = []
    ) {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'errors' => $errors,
            'data' => $data
        ], $code);
    }

    public function ok($data = [])
    {
        return $this->response(
            200,
            'Petición exitosa',
            [],
            $data
        );
    }

    public function created($data = [])
    {
        return $this->response(
            201,
            'Petición exitosa',
            [],
            $data
        );
    }

    public function badRequest($errors = [])
    {
        return $this->response(
            400,
            'Petición errónea',
            $errors,
            []
        );
    }

    public function unauthorized($errors = [])
    {
        return $this->response(
            401,
            'Petición errónea',
            $errors,
            []
        );
    }

    public function forbidden($errors = [])
    {
        return $this->response(
            403,
            'Petición errónea',
            $errors,
            []
        );
    }

    public function notFound($errors = [])
    {
        return $this->response(
            404,
            'Petición errónea',
            $errors,
            []
        );
    }

    public function internalServerError($errors = [])
    {
        return $this->response(
            500,
            'Error interno del servidor',
            $errors,
            []
        );
    }
}
