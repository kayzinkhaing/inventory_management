<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait serviceHelper
{
    protected function getValidatedData(Request $request)
    {
        // dd($request->all());
        $requestClass = $this->resolveRequestClass();
        // dd($requestClass);
        if (!$requestClass) {
            // dd('Request class not found: ' . $this->bladeFolder);
            return [];
        }

        return app($requestClass)->validated();
    }

    protected function createResource(array $data)
    {
        // dd($data);
        return $this->service->create($data);
    }

    protected function updateResource($id, array $data)
    {
        return $this->service->update($id, $data);
    }

    protected function destroyResource($id)
    {
        $this->service->delete($id);
    }

    protected function resolveRequestClass()
    {
        // dd($this->bladeFolder);
        $requestClass = 'App\\Http\\Requests\\' . $this->bladeFolder . 'Request';
        // dd($requestClass);
        // dd(class_exists($requestClass) ? $requestClass : null);
        return class_exists($requestClass) ? $requestClass : null;
    }
}
