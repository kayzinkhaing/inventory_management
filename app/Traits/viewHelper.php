<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Services\commonDropdown;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

trait viewHelper
{
    protected function getBladePath()
    {
        // dd($this->bladeFolder);
        // dd(Route::currentRouteName());
        return Route::currentRouteName();
    }

    public function getDataByModel($model)
    {
        $cacheKey = $this->getClassBaseName($model) . '_dropdown_data';

        // Cache the dropdown data for 60 minutes
        return Cache::remember($cacheKey, 60, function () use ($model) {
            $ddlService = app(commonDropdown::class);
            if (!$ddlService) {
                return []; // Return an empty array or default value if not set
            }
            return $ddlService->getDropdownOptions($model);
        });
    }

    public function getIndexRoute()
    {
        return strtolower($this->bladeFolder) . "." . $this->customVariables->INDEX;
    }

    public function getClassBaseName($className)
    {
        return strtolower(class_basename($className));
    }

    protected function resolveModelClass($key)
    {
        // Adjust the model namespace if your models are elsewhere
        $modelNamespace = 'App\\Models\\';
        $className = ucfirst($key); // turns 'user' into 'User'
        return $modelNamespace . $className;
    }

    protected function buildDropdownData(array $dropDownData): array
    {
        $dropdowns = [];

        foreach ($dropDownData as $modelKey) {
            $modelClass = $this->resolveModelClass($modelKey);
            if ($modelClass && class_exists($modelClass)) {
                $dropdowns[$modelKey . 'Dropdown'] = $this->getDataByModel($modelClass);
            }
        }

        return $dropdowns;
    }

    protected function filterCollection($collection, $searchTerm)
    {
        if (empty($this->searchFields)) {
            return $collection;
        }

        $searchTerm = trim($searchTerm);
        if ($searchTerm === '') {
            return $collection;
        }

        $keywords = preg_split('/\s+/', $searchTerm);

        return $collection->filter(function ($item) use ($keywords) {
            foreach ($keywords as $keyword) {
                $keywordFound = false;
                foreach ($this->searchFields as $field) {
                    $value = $item->$field ?? null;
                    if ($value && stripos($value, $keyword) !== false) {
                        $keywordFound = true;
                        break;
                    }
                }
                if (! $keywordFound) {
                    return false;
                }
            }
            return true;
        })->values();
    }

    public function afterStore($resource)
    {
        if (!$this->notificationClass) {
            return;
        }

        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'Admin');
        })->get();

        foreach ($admins as $admin) {
            $admin->notify(new $this->notificationClass($resource));
        }
    }
}
