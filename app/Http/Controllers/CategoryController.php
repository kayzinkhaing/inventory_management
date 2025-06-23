<?php

namespace App\Http\Controllers;

use App\Services\categories;

class CategoryController extends Controller
{
    protected $user;
    protected $relModels;
    protected $dropDownData;
    protected $categories;

    public function __construct(categories $categories)
    {
        $this->categories = $categories;
        $this->relModels = [];

        $this->dropDownData = [];
        parent::__construct($this->categories, false, $this->dropDownData, $this->relModels);

        parent::__construct(
            $this->categories,
            false,
            $this->dropDownData,
            $this->relModels,
        );
    }
}
