<?php

namespace App\Contracts;

use App\Contracts\baseInterface;
use Illuminate\Support\Collection;

interface categoryInterface extends baseInterface
{
    function getCategorybyId($categoryId);
}
