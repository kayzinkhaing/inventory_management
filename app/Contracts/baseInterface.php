<?php

namespace App\Contracts;

interface baseInterface
{
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function all();
    public function FindById(int $id);
    public function FindByName(string $name);
}
