<?php
namespace App\Repositories\Site;

use App\Models\Site\About;
use App\Repositories\AbstractRepository;

class AboutRepository extends AbstractRepository
{
    public function __construct(About $model)
    {
        parent::__construct($model);
    }
}