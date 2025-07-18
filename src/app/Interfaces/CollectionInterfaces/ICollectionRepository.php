<?php

namespace App\Interfaces\CollectionInterfaces;

use App\Models\Collection;

interface ICollectionRepository
{
    public function findLast(): Collection;

    public function find(int $id): Collection;

    public function getAll();

}
