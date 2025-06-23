<?php

namespace App\Http\Controllers;

use App\Services\brands;

class BrandController extends Controller
{
    protected $user;
    protected $relModels;
    protected $dropDownData;
    protected $brands;

    public function __construct(brands $brands)
    {
        $this->brands = $brands;
        $this->relModels = [];

        $this->dropDownData = [];
        parent::__construct($this->brands, false, $this->dropDownData, $this->relModels);

        parent::__construct(
            $this->brands,
            false,
            $this->dropDownData,
            $this->relModels,
        );
    }
}
