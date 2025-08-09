<?php
namespace App\Repositories\Site;

use App\Models\Site\Service;
use App\Repositories\AbstractRepository;

class ServiceRepository extends AbstractRepository
{
    public function __construct(Service $model)
    {
        parent::__construct($model);
    }
}