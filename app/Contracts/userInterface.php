<?php

namespace App\Contracts;


interface userInterface extends baseInterface
{
    public function getByEmail(string $email);
}
