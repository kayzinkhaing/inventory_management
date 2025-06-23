<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Models\Product;

class Products extends Common
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        parent::__construct($productRepository);
        $this->productRepository = $productRepository;
    }

    public function getFilteredProducts(array $filters = [])
    {
        $query = Product::with(['category', 'brand']);

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('code', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['brand_id'])) {
            $query->where('brand_id', $filters['brand_id']);
        }

        return $query->paginate(10);
    }

    public function getDropDownData(): array
    {
        return [
            'categories' => \App\Models\Category::all(),
            'brands' => \App\Models\Brand::all(),
        ];
    }
}
