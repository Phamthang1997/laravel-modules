<?php

namespace App\Traits\JsonResponse;


use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait MobileResponse
{
    /**
     * Json Success Response
     *
     * @param mixed|null $data
     * @return JsonResponse
     */
    final public function successResponse(mixed $data = null):  JsonResponse
    {
        //@phpstan-ignore-next-line
        return response()->json(
            [
                'status' => true,
                'code'   => ResponseAlias::HTTP_OK,
                'data'   => $data,
            ],
            ResponseAlias::HTTP_OK
        );
    }

    /**
     * Json Created Success Response
     *
     * @param mixed|null $data
     * @return JsonResponse
     */
    final public function createdSuccessResponse(mixed $data = null):  JsonResponse
    {
        if (is_null($data)) {
            $data = new \stdClass();
        }

        //@phpstan-ignore-next-line
        return response()->json([
            'status' => true,
            'code' => 'Created',
            'data' => $data,
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * Json Updated Success Response
     *
     * @param mixed|null $data
     * @return JsonResponse
     */
    final public function updatedSuccessResponse(mixed $data = null):  JsonResponse
    {
        if (is_null($data)) {
            $data = new \stdClass();
        }

        //@phpstan-ignore-next-line
        return response()->json([
            'status' => true,
            'code' => 'Updated',
            'data' => $data
        ], ResponseAlias::HTTP_ACCEPTED);
    }

    /**
     * Json Deleted Success Response
     *
     * @return JsonResponse
     */
    final public function deletedSuccessResponse():  JsonResponse
    {
        //@phpstan-ignore-next-line
        return response()->json([
            'status' => true,
            'code' =>'Deleted',
        ], ResponseAlias::HTTP_NO_CONTENT);
    }

    /**
     * Json Bad Request Error Response
     *
     * @param string|null $code
     * @param mixed|null $message
     * @return JsonResponse
     */
    final public function badRequestErrorResponse(string $code = null, mixed $message = null):  JsonResponse
    {
        //@phpstan-ignore-next-line
        return response()->json(
            [
                'status'     => false,
                'code'       => $code ?? 'HTTP_BAD_REQUEST',
                'message'    => $message,
            ],
            ResponseAlias::HTTP_BAD_REQUEST
        );
    }

    /**
     * Json Not Found Error Response
     *
     * @param string|null $code
     * @param mixed|null $message
     * @return JsonResponse
     */
    final public function notFoundErrorResponse(string $code = null, mixed $message = null):  JsonResponse
    {
        //@phpstan-ignore-next-line
        return response()->json([
            'status' => false,
            'code' => $code ?? 'HTTP_NOT_FOUND' ,
            'message' => $message,
        ], ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Json UnAuthorized Error Response
     *
     * @param string|null $code
     * @param string|null $message
     * @return JsonResponse
     */
    final public function unAuthorizedErrorResponse(string $code = null, string $message = null):  JsonResponse
    {
        //@phpstan-ignore-next-line
        return response()->json([
            'status' => false,
            'code' => !empty($code) ? $code : 'HTTP_UNAUTHORIZED',
            'message' => $message,
        ], ResponseAlias::HTTP_UNAUTHORIZED);
    }

    /**
     * Json Validate Request Error Response
     *
     * @param mixed $message
     * @return JsonResponse
     */
    final public function validateRequestErrorResponse(mixed $message = null):  JsonResponse
    {
        //@phpstan-ignore-next-line
        return response()->json([
            'status' => false,
            'code' => 'Validate',
            'message' => $message,
        ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Json Server Error Response
     *
     * @param string|null $code
     * @param string|null $message
     * @return JsonResponse
     */
    final public function serverErrorResponse(string $code = null, string $message = null):  JsonResponse
    {
        //@phpstan-ignore-next-line
        return response()->json([
            'status' => false,
            'code' => $code ?? 'HTTP_INTERNAL_SERVER_ERROR',
            'message' => $message,
        ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Json Custom Response
     *
     * @param string $code
     * @param mixed $message
     * @param int $status
     * @return JsonResponse
     */
    final public function customErrorResponse(string $code, mixed $message, int $status):  JsonResponse
    {
        //@phpstan-ignore-next-line
        return response()->json([
            'status' => false,
            'code' => $code,
            'message' => $message,
        ], $status);
    }
}