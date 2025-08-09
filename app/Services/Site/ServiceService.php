<?php
namespace App\Services\Site;

use App\Repositories\Site\ServiceRepository;
use App\Services\AbstractService;

class ServiceService extends AbstractService
{
    public function __construct(ServiceRepository $repository)
    {
        parent::__construct($repository);
    }
}