<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;
use Response;

trait ApiResponse
{
    /**
     * @var int
     */
    protected $statusCode = FoundationResponse::HTTP_OK;

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @param mixed $httpCode
     * @return $this
     */
    public function setStatusCode(int $statusCode, $httpCode = null)
    {
        $this->statusCode = $httpCode ?? $statusCode;
        return $this;
    }

    /**
     * @param array $data
     * @param array $header
     * @param int $options
     * @return JsonResponse
     */
    public function respond(array $data, array $header = [], int $options = 0): JsonResponse
    {

        return Response::json($data, $this->getStatusCode(), $header, $options);
    }

    /**
     * @param string $status
     * @param array $data
     * @param null $code
     * @return JsonResponse
     */
    public function status(string $status, array $data, $code = null): JsonResponse
    {

        if ($code) {
            $this->setStatusCode($code);
        }
        $status = [
            'status' => $status,
            'code' => $this->statusCode
        ];

        $data = array_merge($status, $data);
        return $this->respond($data);

    }

    /**
     * @param string $message
     * @param int $code
     * @param string $status
     * @return JsonResponse
     */
    public function failed(string $message, int $code = FoundationResponse::HTTP_BAD_REQUEST, string $status = 'error'): JsonResponse
    {

        return $this->setStatusCode($code)->message($message, $status);
    }

    /**
     * @param string $message
     * @param string $status
     * @return JsonResponse
     */
    public function message(string $message, string $status = 'success'): JsonResponse
    {

        return $this->status($status, [
            'message' => $message
        ]);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function internalError(string $message = 'Internal Error!'): JsonResponse
    {

        return $this->failed($message, FoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function created(string $message = 'created'): JsonResponse
    {
        return $this->setStatusCode(FoundationResponse::HTTP_CREATED)
            ->message($message);

    }

    /**
     * @param mixed $data
     * @param string $status
     * @return JsonResponse
     */
    public function success($data, string $status = 'success'): JsonResponse
    {

        return $this->status($status ?: 'success', compact('data'));
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function notFond(string $message = 'Not Fond!'): JsonResponse
    {
        return $this->failed($message, Foundationresponse::HTTP_NOT_FOUND);
    }
}
