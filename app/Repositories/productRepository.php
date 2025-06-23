<?php

namespace App\Repositories;

use App\Contracts\productInterface;

class productRepository extends baseRepository implements productInterface
{
    public function __construct()
    {
        parent::__construct(class_basename("Product"));
    }
    public function getProductById($productId)
    {
        return $this->currentModel->find($productId);
    }
}
