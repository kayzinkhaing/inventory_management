<?php

namespace App\Contracts;

use App\Contracts\baseInterface;
use Illuminate\Support\Collection;

interface productInterface extends baseInterface
{
    function getProductById($productId);
}
