<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait apiResponse
{
    protected function apiResponse($data, $status = 200, $message = null)
    {
        if ($message) {
            return response()->json(['data' => $data, 'message' => $message], $status);
        }
        return response()->json(['data' => $data], $status);
    }

    protected function apiErrorResponse($message, $status = 400)
    {
        return response()->json(['error' => $message], $status);
    }

    protected function isApiRequest()
    {
        return request()->is('api/*');
    }

    protected function generateResponse(array $data = [])
    {
        // dd($data);
        if ($this->isApiRequest()) {
            return $this->apiResponse($data);
        }
        // dd($this->getIndexRoute());

        return redirect()->route($this->getIndexRoute());
    }
}
