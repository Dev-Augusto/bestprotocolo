<?php
namespace App\Repositories\Site;

use App\Models\Site\ImagesService;
use App\Repositories\AbstractRepository;

class ImagesServiceRepository extends AbstractRepository
{
    public function __construct(ImagesService $model)
    {
        parent::__construct($model);
    }
}