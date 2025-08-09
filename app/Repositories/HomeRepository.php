<?php
namespace App\Repositories;

use App\Models\Home;
use App\Repositories\AbstractRepository;

class HomeRepository extends AbstractRepository
{
    public function __construct(Home $model)
    {
        parent::__construct($model);
    }
}