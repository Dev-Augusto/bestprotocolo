<?php
namespace App\Repositories\Site;

use App\Models\Site\Partner;
use App\Repositories\AbstractRepository;

class PartnerRepository extends AbstractRepository
{
    public function __construct(Partner $model)
    {
        parent::__construct($model);
    }
}