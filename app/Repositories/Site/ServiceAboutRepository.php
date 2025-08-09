<?php
namespace App\Repositories\Site;

use App\Models\Site\ServiceAbout;
use App\Repositories\AbstractRepository;

class ServiceAboutRepository extends AbstractRepository
{
    public function __construct(ServiceAbout $model)
    {
        parent::__construct($model);
    }
}