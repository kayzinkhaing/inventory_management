<?php

namespace App\Contracts;

use App\Contracts\baseInterface;
use Illuminate\Support\Collection;

interface brandInterface extends baseInterface
{
    function getBrandbyId($brandId);
}
