<?php

namespace App\Repositories;

use App\Export\ExportKycColectivo;
use App\Export\ExportKycSingular;
use App\Helpers\FilterHandler;
use App\Helpers\FilterHandlerV2;
use App\Helpers\OrderHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class AbstractRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(?int $paginate, ?array $filterParams, ?array $orderByParams, $relationships = [])
    {
        return $this->buildQuery($paginate, $filterParams, $orderByParams, $relationships);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    protected function buildQuery($paginate = null, $filterParams = null, $orderByParams = null, $relationships = [], $count = null)
    {
        $query = $this->model->query();

        if (in_array(SoftDeletes::class, class_uses($this->model))) {
            // $query = $query->withTrashed();
        }

        $relationships = $filterParams['relationships'] ?? $relationships;
        unset($filterParams['relationships']);

        if (is_array($relationships) && !empty($relationships)) {
            $query = $query->with($relationships);
        }

        $query = $this->applyFilter($query, $filterParams);
        $query = $this->applyOrder($query, $orderByParams);

        return $this->paginateQuery($query, $paginate, $filterParams, $count);
    }

    protected function applyFilter($query, $filterParams)
    {
        if (isset($filterParams)) {
            $filterHandler = new FilterHandler;
            $filterHandlerV2 = new FilterHandlerV2;

            $version = $this->getVersionFilter($filterParams);
            if ($version === 1) {
                return $filterHandler->applyFilter($query, $filterParams);
            }

            return $filterHandlerV2->applyFilter($query, $filterParams);
        }

        return $query;
    }

    protected function applyOrder($query, $orderByParams)
    {
        if (isset($orderByParams)) {
            $orderHandler = new OrderHandler;
            return $orderHandler->applyOrder($query, $orderByParams);
        }

        return $query;
    }

    protected function paginateQuery($query, $paginate = null, $filterParams = null, $count = null)
    {
        if (!isset($paginate)) {
            return $query->take(100)->get();
        }

        $pagedData = $query->paginate($paginate);
        $data = collect();

        $this->addCountToData($data, $count);
        $data = $this->addFixedConditionToData($data, $filterParams);
        return $data->isNotEmpty() ? $data->merge($pagedData) : $pagedData;
    }

    protected function addCountToData($data, $count)
    {
        if (isset($count)) {
            $data->put('count', $count);
        }
    }

    protected function addFixedConditionToData($data, $filterParams)
    {
        $fixedCondition = $this->getFixedCondition($filterParams);
        if ($fixedCondition) {

            $key = $this->model::firstWhere($fixedCondition)?->getKey();
            $fixedData = collect(['fixed' => $key ? $this->show($key) : null]);
            return $data->merge($fixedData);
        }
        return $data;
    }

    public function getVersionFilter(?array $filterParams)
    {
        $firstKey = array_key_first($filterParams);
        return is_int($firstKey) ? 2 : 1;
    }

    /**
     * Get condition to find fixed register
     */
    protected function getFixedCondition(?array $filters): ?array
    {
        if (empty($filters)) return null;

        $version = $this->getVersionFilter($filters);
        if ($version === 1) {

            foreach ($filters as $key => $filter) {
                if (isset($filter['filterType']) && $filter['filterType'] === 'FIXED') {
                    return [mb_strtolower($key) => $filter['filterValue']];
                }
            }
        } else {
            foreach ($filters as $key => $filter) {
                if (isset($filter['filterType']) && $filter['filterType'] === 'FIXED') {
                    return [mb_strtolower($filter['field']) => $filter['filterValue']];
                }
            }
        }

        return null;
    }

    /**
     * Get condition to find fixed register
     */
    protected function getConditionByField(?array $filters, $field): ?array
    {
        if (empty($filters)) return null;

        $version = $this->getVersionFilter($filters);
        if ($version === 1) {

            foreach ($filters as $key => $filter) {
                if (isset($filter['field']) && $filter['field'] === $field) {
                    return [mb_strtolower($key) => $filter['filterValue']];
                }
            }
        } else {
            foreach ($filters as $key => $filter) {
                if (isset($filter['field']) && $filter['field'] === $field) {
                    return [mb_strtolower($filter['field']) => $filter['filterValue']];
                }
            }
        }

        return null;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(int|string $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Display the first resource.
     */
    public function first()
    {
        return $this->model->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(array $data, int $id)
    {
        $model = $this->model->findOrFail($id);
        $model->update($data);

        return $model;
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateOrCreate(array $attributes, array $values)
    {
        return $this->model->query()
            ->updateOrCreate($attributes, $values);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $model = $this->model->findOrFail($id);
        $model->delete();
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(int $id)
    {
        $model = $this->model->withTrashed()->findOrFail($id);
        $model->restore();

        return $model;
    }

    /**
     * Find a resource by the specified criteria.
     */
    public function findOneBy(array $criteria)
    {
        $model = $this->model->query()
            ->where($criteria)
            ->first();

        return $model;
    }

    /**
     * Find a resource by the specified criteria.
     */
    public function findAllBy(array $criteria)
    {
        return $this->model->query()
            ->where($criteria)
            ->get();
    }

    public function findAllOr(array $first,array $second)
    {
        return $this->model->query()
            ->where($first)->orWhere($second)
            ->get();
    }

    public function findAllWhereIn(array $array)
    {
        return $this->model->query()
            ->WhereIn($array)
            ->get();
    }

    public function findOneByWithRelationships(array $criteria, array $relationships)
    {
        return $this->model->query()
            ->where($criteria)
            ->with($relationships)
            ->first();
    }

    public function findAllByWithRelationships(array $criteria, array $relationships)
    {
        return $this->model->query()
            ->where($criteria)
            ->with($relationships)
            ->get();
    }

    /**
     * Destroy a resource by the specified criteria.
     */
    public function deleteBy(array $criteria)
    {
        return $this->model->query()
            ->where($criteria)
            ->delete();
    }

    /**
     * Restore a resource by the specified criteria.
     */
    public function restoreBy(array $criteria)
    {
        $models = $this->model->withTrashed()
            ->whereNotNull('deleted_at')
            ->where($criteria)
            ->get();

        foreach ($models as $model) {
            $model->restore();
        }

        return $models;
    }

    public function getTotal()
    {
        return $this->model->withTrashed()->count();
    }

    public function exportKycSingular()
    {
        ExportKycSingular::saveExcel();
    }

    public function exportKycEmpresarial()
    {
        ExportKycColectivo::saveExcel();
    }
}
