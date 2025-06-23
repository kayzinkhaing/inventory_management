<?php

namespace App\Services;

use App\Repositories\brandRepository;

use App\Repositories\categoryRepository;

class brands extends common
{
    protected $brandRepository;

    public function __construct(brandRepository $brandRepository)
    {
        parent::__construct($brandRepository);
        $this->brandRepository = $brandRepository;
    }

    // Role-specific logic, not CRUD
    public function query()
    {
        return \App\Models\Brand::query();
    }

}
