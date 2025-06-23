<?php

namespace App\Repositories;

use App\Contracts\brandInterface;

class brandRepository extends baseRepository implements brandInterface
{
    public function __construct()
    {
        parent::__construct(class_basename("Brand"));
    }
    public function getBrandbyId($brandId)
    {
        return $this->currentModel->find($brandId);
    }
}
