<?php

namespace App\Services;

use App\Contracts\baseInterface;
use App\Contracts\RepositoryInterface;
use App\Repositories\baseRepository;

class Common
{
    protected  $repository;

    // Constructor is used to inject the appropriate repository (e.g., RoleRepository, PermissionRepository)
    public function __construct($repository)
    {
        $this->repository = $repository;
    }
     public function getModel()
    {
        return $this->repository->currentModel;
    }

    // Magic method to forward method calls to the repository
    public function __call($method, $args)
    {
        // Check if the method exists in the repository
        if (method_exists($this->repository, $method)) {
            return call_user_func_array([$this->repository, $method], $args);
        }
        // Throw an exception if method doesn't exist in the repository
        throw new \BadMethodCallException("Method {$method} does not exist in " . get_class($this) . ".");
    }
}
