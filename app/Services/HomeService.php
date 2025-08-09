<?php
namespace App\Services;

use App\Repositories\HomeRepository;
use App\Services\AbstractService;

class HomeService extends AbstractService
{
    public function __construct(HomeRepository $repository)
    {
        parent::__construct($repository);
    }
}