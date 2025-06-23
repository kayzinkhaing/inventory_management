<?php

namespace App\Repositories;

use App\Models\Role;
use App\Contracts\roleInterface;
use Illuminate\Support\Collection;
use App\Contracts\categoryInterface;

class categoryRepository extends baseRepository implements categoryInterface
{
    public function __construct()
    {
        parent::__construct(class_basename("Category"));
    }
    public function getCategorybyId($categoryId)
    {
        return $this->currentModel->find($categoryId);
    }
}
