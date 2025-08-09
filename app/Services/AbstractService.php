<?php

namespace App\Services;

use App\Repositories\AbstractRepository;
use Illuminate\Support\Collection;

abstract class AbstractService
{
    protected AbstractRepository $repository;

    public function __construct(AbstractRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(?int $paginate, ?array $filterParams, ?array $orderByParams, $relationships = [])
    {
        return $this->repository->index($paginate, $filterParams, $orderByParams, $relationships);
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(int|string $id)
    {
        return $this->repository->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(array $data, int $id)
    {
        return $this->repository->update($data, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->repository->destroy($id);
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(int $id)
    {
        return $this->repository->restore($id);
    }

    /**
     * Attaches a given ID to each item in an array.
     *
     * @param int $id The ID to be attached.
     * @param array $items The array of items to attach the ID to.
     * @param string $nameNewId The key to use for the new ID in each item.
     * @return array The updated array of items with the attached ID.
     */
    public function attachIdToArray(int $id, array $items, string $nameNewId): array
    {
        if (isset($items[0]) === false) {
            $items[$nameNewId] = $id;
            return $items;
        }

        $updatedItems = [];
        foreach ($items as $item) {
            if (is_array($item)) {
                $item[$nameNewId] = $id;
                $updatedItems[] = $item;
            }
        }
        return $updatedItems;
    }

    public function findAllBy(array $criteria): Collection
    {
        return $this->repository->findAllBy($criteria);
    }

    public function findAllOr(array $first, array $second)
    {
        return $this->repository->findAllOr($first, $second);
    }

    public function findOneBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    public function findOneByWithRelationships($criteria, $relationships)
    {
        return $this->repository->findOneByWithRelationships($criteria, $relationships);
    }

    public function findAllByWithRelationships($criteria, $relationships)
    {
        return $this->repository->findAllByWithRelationships($criteria, $relationships);
    }

    public function deleteBy(array $criteria)
    {
        $this->repository->deleteBy($criteria);
    }

    public  function returnApi($messages, $status, $data = null, $header = null)
    {
        $response = ['status' => '0', 'message' => 'Validation error'];
        $response['status'] = $status;
        $response['message'] = $messages;
        if ($data != null) {
            $response['data'] = $data;
        }
        return response()->json($response, $status)->withHeaders([
            $header
        ]);
    }

    public function isAssociativeArray(array $array): bool
    {
        if ([] === $array)
            return false;
        return array_keys($array) !== range(0, count($array) - 1);
    }

    public function exportKycSingular()
    {
        $this->repository->exportKycSingular();
    }

    public function exportKycEmpresarial()
    {
        $this->repository->exportKycEmpresarial();
    }
}
