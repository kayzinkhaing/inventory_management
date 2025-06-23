<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Contracts\roleInterface;
use Illuminate\Support\Collection;
use App\Repositories\roleRepository;

use App\Repositories\categoryRepository;

class categories extends common
{
    protected $categoryRepository;

    public function __construct(categoryRepository $categoryRepository)
    {
        parent::__construct($categoryRepository);
        $this->categoryRepository = $categoryRepository;
    }

    // Role-specific logic, not CRUD
    public function query()
    {
        return \App\Models\Category::query();
    }

}
