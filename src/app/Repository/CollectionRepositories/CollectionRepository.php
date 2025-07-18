<?php

namespace App\Repository\CollectionRepositories;

use App\Interfaces\CollectionInterfaces\ICollectionRepository;
use App\Models\Collection;

class CollectionRepository implements ICollectionRepository
{
    public function findLast(): Collection
    {
        return Collection::query()->latest()->with('products')->first();
    }

    public function find(int $id): Collection
    {
        return Collection::query()->find($id)->with('products')->first();

    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Collection::query()->get();
    }
}
