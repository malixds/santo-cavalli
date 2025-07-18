<?php

namespace App\Http\Controllers;

use App\Interfaces\CollectionInterfaces\ICollectionRepository;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{

    public function __construct(private readonly ICollectionRepository $repository)
    {
    }

    public function getAllCollections()
    {
        $collections = $this->repository->getAll();

        return view('pages.collections.all_collection', [
            'collection' => $collections,
        ]);
    }

    public function getCollection(int $id = null)
    {
        if ($id === null) {
            $collection = $this->repository->findLast();
        } else {
            $collection = $this->repository->find($id);
        }

        return view('pages.collections.new_collection', [
            'collection' => $collection,
        ]);
    }
}
