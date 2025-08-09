<?php
namespace App\Services\Site;

use App\Repositories\Site\ServiceAboutRepository;
use App\Services\AbstractService;

class ServiceAboutService extends AbstractService
{
    public function __construct(ServiceAboutRepository $repository)
    {
        parent::__construct($repository);
    }
}