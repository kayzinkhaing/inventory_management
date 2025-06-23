<?php

namespace App\Http\Controllers;

use App\Services\products;
use Illuminate\Support\Facades\Request;

class ProductController extends Controller
{
    protected $user;
    protected $relModels;
    protected $dropDownData;
    protected $products;

    public function __construct(products $products)
    {
        $this->products = $products;
        $this->relModels = ['category', 'brand','images'];

        $this->dropDownData = ['category', 'brand'];
        parent::__construct($this->products, false, $this->dropDownData, $this->relModels);

        parent::__construct(
            $this->products,
            false,
            $this->dropDownData,
            $this->relModels,
        );
    }

    public function index()
    {
        $filters = [
            'search' => request()->input('search'),
            'category_id' => request()->input('category_id'),
            'brand_id' => request()->input('brand_id'),
        ];

        $viewData = parent::index()->getData(); // optional if using base setup

        $viewData['products'] = $this->products->getFilteredProducts($filters);
        $dropdowns = $this->products->getDropDownData();

        $viewData['categories'] = $dropdowns['categories'];
        $viewData['brands'] = $dropdowns['brands'];

        return view('products.index', $viewData);
    }



}
