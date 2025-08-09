<?php
namespace App\Services\Site;

use App\Repositories\Site\PartnerRepository;
use App\Services\AbstractService;

class PartnerService extends AbstractService
{
    public function __construct(PartnerRepository $repository)
    {
        parent::__construct($repository);
    }
}