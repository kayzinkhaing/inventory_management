<?php

namespace App\Traits;

use App\Services\configFiles;

trait configFileHandler
{
    protected function shouldHandleConfigFile(): bool
    {
        return class_basename($this->service) === config('custom_variables.MSG_SERVICE');
    }

    public function handleConfigFile($data)
    {
        $confService = app(configFiles::class);
        $confService->updateConfigFile(
            strtoupper($data['name']),
            $data['name']
        );
    }

    public function removeConfigFileKey($key)
    {
        $confService = app(configFiles::class);
        $confService->removeConfigFileKey(strtoupper($key));
    }
}
