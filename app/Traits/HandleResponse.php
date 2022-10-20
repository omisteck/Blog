<?php
namespace App\Traits;

use Inertia\Inertia;

/**
 * response handling traits
 */
trait HandleResponse
{
    public function JsonResponse($data, string $message='Request Successful', int $statusCode=200)
    {
        return [
            'statusCode' => $statusCode,
            'message' => $message,
            'data'=> $data
        ];
    }


    public function InertiaResponse($component, $data=[])
    {

        return Inertia::render($component, $data);
    }

}
