<?php

namespace App\Support\Traits;

use Illuminate\Http\JsonResponse;

trait JsonResponseHandler
{
    /**
     * Unauthorized JSON JsonResponse
     *
     * @param string|null $message
     * @return JsonResponse
     */
    public function unauthorized(string $message = null): JsonResponse
    {
        $message = $message ?? trans('Unauthorized.');

        return response()->json(compact('message'), JsonResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * Not acceptable JSON JsonResponse
     *
     * @param string|null $message
     * @return JsonResponse
     */
    public function notAcceptable(string $message = null): JsonResponse
    {
        $message = $message ?? trans('Code Incorrect.');

        return response()->json(compact('message'), JsonResponse::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * Not content JSON JsonResponse
     *
     * @param string|null $message
     * @return JsonResponse
     */
    public function noContent(string $message = null): JsonResponse
    {
        $message = $message ?? trans('No Content.');

        return response()->json(compact('message'), JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * Access denied JSON JsonResponse
     *
     * @param string|null $message
     * @return JsonResponse
     */
    public function forbidden(string $message = null): JsonResponse
    {
        $message = $message ?? trans('Access denied.');

        return response()->json(compact('message'), JsonResponse::HTTP_FORBIDDEN);
    }

    /**
     * Not found JSON JsonResponse
     *
     * @param string|null $message
     * @return JsonResponse
     */
    public function notFound(string $message = null): JsonResponse
    {
        $message = $message ?? trans('Resource not found.');

        return response()->json(compact('message'), JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * OK JSON JsonResponse
     *
     * @param array $data
     * @param string|null $message
     * @return JsonResponse
     */
    private function success(array $data = [], string $message = null): JsonResponse
    {
        $message = $message ?? trans('Was Successful.');

        return response()->json(array_merge(compact('message'), $data), JsonResponse::HTTP_OK);
    }

    /**
     * Created JSON JsonResponse
     *
     * @param array $data
     * @param string|null $message
     * @return JsonResponse
     */
    private function created(array $data = [], string $message = null): JsonResponse
    {
        $message = $message ?? trans('Was Successful.');

        return response()->json(array_merge(compact('message'), $data), JsonResponse::HTTP_CREATED);
    }

    /**
     * Too many requests JSON JsonResponse
     *
     * @param string|null $message
     * @return JsonResponse
     */
    private function tooManyRequest(string $message = null): JsonResponse
    {
        $message = $message ?? trans('Too many requests.');

        return response()->json(compact('message'), JsonResponse::HTTP_TOO_MANY_REQUESTS);
    }

    /**
     * Server err JSON JsonResponse
     *
     * @param string|null $message
     * @return JsonResponse
     */
    private function serverErr(string $message = null): JsonResponse
    {
        $message = $message ?? trans('Server error.');

        return response()->json(compact('message'), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
}
